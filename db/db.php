<?php
class database
{
	private static $table;
	private static $mysqli;
	public static function connect()
	{
		include 'config.php';
		database::$table = $info['table'];
		$m = new mysqli(
 			$info['server'],
 			$info['user'],
 			$info['pass'],
 			$info['base']
 		);
 		#print_r($m);
 		if($m->connect_errno == 2002) return 0;
		database::$mysqli = $m;
		return 1;
	}
	public static function disconnect()
	{
		database::$mysqli->close();
	}
	#================================

	private static function query($sql)
	{
		$result = database::$mysqli->query($sql);
			if( !$result ){
				database::disconnect();
				database::connect();
				$result = database::$mysqli->query($sql);
				return $result;
			}else{
				return $result;
			}
	}
	#================================


	public static function getAccount($id, $type = false)
	{
		if(!$type)
		{
			$res = database::query("SELECT * FROM ".database::$table." WHERE user_id = '$id'");
			if(!$res)
			{
				return 0;
			}else{
				$res = $res->fetch_assoc();
				return $res;
			}
		}
		else
		{
			$res = database::query("SELECT * FROM ".database::$table." WHERE id = '$id'");
			if(!$res)
			{
				return 0;
			}else{
				$res = $res->fetch_assoc();
				return $res;
			}
		}
	}
	public static function newAccount($id)
	{
		$res = database::query("INSERT INTO ".database::$table." (user_id) VALUES ('$id')");
		if(!$res)
		{
			return 0;
		} else return $res;	
	}
	public static function updateAccount($searchParam,$searchValue,$param,$value, $type="0")
	{
				$is = database::query("SELECT $searchParam FROM ".database::$table." WHERE $searchParam='$searchValue'");
				$is = $is->fetch_assoc();
			if(!$is){
				return 0;
			}else{
				$old = database::query("SELECT $param FROM ".database::$table." WHERE $searchParam='$searchValue'");
				//$old = $old->fetch_assoc();
					if(!$old){
						return 2; // UPDATE | Если не найден параметр у искомой строки
					}else{
						switch($type){
						case "+":
							$oldParam = database::query("SELECT $param FROM ".database::$table." WHERE $searchParam='$searchValue'");
							$oldValue = $oldParam->fetch_assoc();
							$value = $oldValue[$param] + $value;
							database::query("UPDATE ".database::$table." SET $param='$value' WHERE $searchParam='$searchValue'");
							return 1;
						break;
						case "-":
							$oldParam = database::query("SELECT $param FROM ".database::$table." WHERE $searchParam='$searchValue'");
							$oldValue = $oldParam->fetch_assoc();
							if($value > $oldValue[$param]){
								return 3; // Если больше
							}else{
							$value = $oldValue[$param] - $value;
							database::query("UPDATE ".database::$table." SET $param='$value' WHERE $searchParam='$searchValue'");
							return 1;
							}
						break;
						case "0":
							database::query("UPDATE ".database::$table." SET $param='$value' WHERE $searchParam='$searchValue'");
							return 1;
						break;
						}
					}
			}
	}
	public static function getConfig($config)
	{
		if($config == 'all')
		{
			$res = database::query("SELECT * FROM bot_config");
			if(!$res)
			{
				return 0;
			}else{
				$r = "";
				do{
					if(!$rows) continue;
					$r[$rows['conf_name']] = $rows['conf_value'];
				}while($rows = $res->fetch_assoc());
				return $r;
			}
			$res->close();
		}else{
			$res = database::query("SELECT * FROM bot_config WHERE conf_name = '$config'");
				if(!$res)
				{
					return 0;
				}else{
					$res = $res->fetch_assoc();
					return $res;
				}
			$res->close();
		}
	}
	public static function setConfig($config, $value)
	{
		database::query("UPDATE bot_config SET conf_name = '$config' WHERE conf_value = '$value'");
		return 1;
	}

	public function __destruct()
	{
		print_r('Distruct');
		database::disconnect();
	}
}
?>