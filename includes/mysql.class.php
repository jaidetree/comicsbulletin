<?php 
##########################################################################################
# NAME: MySQL Database Handler 															 #
# DATE: 5.28.2009																		 #
# VERSION: 1.0																			 #
# AUTHOR: Jay [ Aetkinz Designs, Inc. ]												     #
#																						 #
# DESCRIPTION:																			 #
#   Handles all the mysl database connections.                                           # 
##########################################################################################

class MySQL extends DataBase
{
	function __construct($host, $user, $password, $db)
	{
        $this->vars['host'] = $host;
        $this->vars['user'] = $user;
        $this->vars['password'] = $password;
        $this->vars['name'] = $db;
        $this->vars['pre'] = APP::cfg('db', 'prefix');
	}
	
	function connect()
	{
		$this->db = new mysqli($this->vars['host'], $this->vars['user'], $this->vars['password'], $this->vars['name']);
		if( ! $this->db )
		{
			ERROR::add(array(
				'file' => $_SERVER['SCRIPT_FILENAME'],
				'line' => $this->query_count,
				'str' => 'Could not connect to mysql database!',
				'sender' => 'Database',
			));
			return FALSE;  
		}
		
		
		$this->db->query("SET NAMES 'utf8'", $this->link);
		
		return TRUE;
	}
	
	function update($table, $fields, $where = '', $limit = '')
	{
		$update = $this->array2update( $fields );
		
		if( ! preg_match( "#`#", $table ) )
		{
			$table = "`$table`"; 
		}
		
		$query = "UPDATE " . $table . " SET " . $update;
		
		if( $where )
		{
			$query .= " WHERE " . $where;
		}
		if( $limit )
		{
			$query .= " LIMIT " . intval($limit);
		}
		
		return $this->query( $query );
	}
	
	function insert($table, $fields)
	{
		$insert = $this->array2insert( $fields );
		
		$query = "INSERT INTO `$table` $insert";
		
		return $this->query( $query );
	}
	
	function delete($table, $where, $limit = '')
	{
		$query = "DELETE FROM `$table` WHERE $where";
		
		if( is_int( $limit ) )
			$query .= " LIMIT $limit";
		
		return $this->query( $query );
	}
	
	function truncate( $table )
	{
		$query = "TRUNCATE TABLE `$table`";
		
		return $this->query( $query );
	}
	
	function optimize( $table)
	{
		if( ! $table )
			return false;
			
		if( is_array( $table ) )
		{
			$query = "OPTIMIZE TABLE ";
			foreach($table as $t)
			{
				$query .= "`$t`,";
			}
			$query = preg_replace( "/,$/", '', $query );
		}
		else
		{
			$query = "OPTIMIZE TABLE `$table`";
		}
		return $this->query( $query );
	}
	
	function optimize_all()
	{
		if( ! $this->link )
			$this->connect();
		
		$result = mysql_list_tables( $this->vars['name'], $this->link);
		
		$tables = mysql_num_rows( $result );
		
		
		for( $i = 0; $i < $tables; $i++ )
		{
			$table = mysql_tablename( $result, $i );
			
			$this->optimize( $table );
		}
		return true;
	}

    function build_where($where)
    {
        $statement = " WHERE";
        if( ! is_array( $where ) )
        {
            return $statement . " " . $where;
        }
        foreach( $where as $item )
        {
            $str = " ";
            /**
             * Is this item a table name?
             */
            if( preg_match('/([_a-z]+)\.([_a-z]+)/', $item, $vars) )
            {
                $str .= $vars[1] . ".`" . $vars[2] . "`";
            }

            elseif( preg_match('/^[=\<\>]+$/', $item, $vars) )
            {
                $str .= $vars[0];
            }
            elseif( $item == "LIKE" || $item == "IS NULL" || $item == "IS NOT NULL" || $item == "AND" || $item == "OR" )
            {
                $str .= $item;
            }
            elseif( preg_match('/^([_a-z]+_[_a-z]|[_\w]+id)+$/', $item, $vars) )
            {
                $str .= "`" . $item . "`";
            }
            elseif( preg_match("/^'.*'$/", $item ) )
            {
                $str .= $item;
            }
            else
            {
                $str .= "'" . $this->escape($item) . "'";
            }

            $statement .= $str;
        }

        return $statement;
    }
	
	function select($table, $select = '*', $where = array(), $order,  $group = '', $limit = '', $count = false) 
	{
		$query = "SELECT $select FROM `$table`";
		
		
		if( $where )
		{
			$query .= $this->build_where($where);
		}
		
		if( is_array( $order ) )
		{
			$sql = " ORDER BY ";
			foreach( $order as $tbl)
			{
				$pieces = explode(" ", $tbl);
				$pieces[0] = strstr( $pieces[0], "`") ? $pieces[0] : "`$pieces[0]`";
				$pieces[1] = $pieces[1] ? $pieces[1] : "ASC";
				$sql .= "$pieces[0] $pieces[1],";
			}
			$query = preg_replace( "/,$/", '', $sql );
		}
		elseif( $order and ! is_array( $order ) )
		{
			if( preg_match( "#[`a-zA-Z0-9_]+ [A-Z0-9]+#", $order ) )
			{ 
				$pieces = explode(" ", $order);
				$pieces[0] = strstr( $pieces[0], "`") ? $pieces[0] : "`$pieces[0]`";
				$pieces[1] = $pieces[1] ? $pieces[1] : "ASC";
				
				$query .= " ORDER BY $pieces[0] $pieces[1]";
			}else{
				$query .= " ORDER BY $order";
			}
		}
		
		if( is_array( $group ) )
		{
			$sql = " GROUP BY ";
			foreach( $group as $tbl )
			{
				$sql .= "`$tbl`,";
			}
			$query .= preg_replace( "/,$/", '', $sql );
		}
		elseif( $group and ! is_array( $group ) )
		{
			$query = " GROUP BY `$group`";
		}
		
		if( $limit )
		{
			$query .= " LIMIT $limit";
		}
		$result = $this->query( $query );
		
		if( $count )
			$this->row_count( $result );
		
		return $result;
		
	}
	
	function start_select($table, $select = '*', $where = array())
	{
		if( is_array( $table ) )
		{
			$key = key( $table );
			$table = "`" . $key . "` " . $table[ $key ];
		}
		else
		{
			$table = "`" . $table . "`";
		}
		$this->sql = "SELECT $select FROM $table";
		
		if( $where )
		{
			$this->sql .= $this->build_where($where);
		}
	}
	
	function start_select_join( $table, $select, $sub_queries, $where = '')
	{
		$selects = array();
		$froms = array();
		$joins = array();
		
		foreach($table as $tbl => $alias)
		{
			$from = "`$tbl` $alias";
		}
		$selects[] = $select;
		
		foreach( $sub_queries as $join )
		{
			$selects[] = $join['select'];
			foreach($join['from'] as $tbl => $alias)
			{
				if( $join['type'] == "left" )
				{
					$joins[] = "LEFT JOIN `$tbl` $alias ON $join[on]";
				}
				else
				{
					$joins[] = "INNER JOIN `$tbl` $alias ON $join[on]";
				}
			}
		}
		
		$select_str = implode( "," , $selects);
		
		$join_str = implode( "\n\t" , $joins );
		
		$this->sql = "SELECT $select_str FROM $from";
		
		if( $join_str )
		{
			$this->sql .= "\n\t$join_str";
		}
		
		if( $where )
			$this->sql .= "\n" . $this->build_where($where);
	}
	
	function start_update($table, $vars, $where = '')
	{
		if( ! preg_match( "#`|.#", $table ) )
		{
			$table = "`$table`";
		}
		
		$this->sql = "UPDATE $table SET ";
		$this->sql .= $this->array2update( $vars );
		
		if( $where )
			$this->sql .= " WHERE $where";
		
		if( preg_match("#phpbb_topics#", $this->sql ) )
		{
			//echo $this->sql;
			//die();
		}
	}
	function start_insert($table, $vars)
	{
		$this->sql = "INSERT INTO `$table` ";
		$this->sql .= $this->array2insert( $vars );
	}
	
	function start_delete($table, $where)
	{
		$this->sql = "DELETE FROM `$table` WHERE $where";
	}
	
	function add_order( $order)
	{
		if( is_array( $order ) )
		{
			$sql = " ORDER BY ";
			foreach( $order as $tbl)
			{
				$pieces = explode(" ", $tbl);
				$pieces[0] = strstr( $pieces[0], "`") ? $pieces[0] : "`$pieces[0]`";
				$pieces[1] = $pieces[1] ? $pieces[1] : "ASC";
				$sql .= "$pieces[0] $pieces[1],";
			}
			$sql = preg_replace( "/,$/", '', $sql );
		}
		else
		{
			if( preg_match( "#^[`a-zA-Z0-9_]+ [A-Z0-9]+$#", $order ) )
			{ 
				$pieces = explode(" ", $order);
				$pieces[0] = strstr( $pieces[0], "`") ? $pieces[0] : "`$pieces[0]`";
				$pieces[1] = $pieces[1] ? $pieces[1] : "ASC";
			
				$sql = " ORDER BY $pieces[0] $pieces[1]";
			}else{
				$sql = " ORDER BY $order";
			}
			
		}
		$this->sql .= $sql;
	}
	
	function add_group( $group )
	{
		if( is_array( $group ) )
		{
			$sql = " GROUP BY ";
			foreach( $group as $tbl )
			{
				$sql .= "`$tbl`,";
			}
			$sql = preg_replace( "/,$/", '', $sql );
		}
		else
		{
			$sql = " GROUP BY $group";
		}
		$this->sql .= $sql;
	}
	
	function add_limit( $limit )
	{
		$this->sql .= " LIMIT $limit";
	}

	
	function query($sql)
	{
		if( ! $this->link)
		{
			$this->connect();
		}
		
		if( is_array( $sql ) )
		{
			APP::dbg( $sql );
		}
		$this->result = $this->db->query( $sql, $this->link );
		
		$this->query_count++;
		
		if( ! $this->result  )
		{	
			//function error($str, $file, $line, $sender = 'Database')
			ERROR::add( array(
				'sender' => 'Database',
				'str' => $this->db->error,
				'sql' => htmlentities( $sql ),
				'file' => $_SERVER['SCRIPT_FILENAME'],
				'count' => $this->query_count,
			));
		}
		
		return $this->result;
	}
	
	function free($result = '')
	{
		if( ! $result )
		{
			$result =& $this->result;
		}
		
		$result->free();
	}
	
	function fetch($result = '', $method = MYSQL_ASSOC)
	{
		if( ! $result )
			$result = $this->result;
		
		if( ! $result )
		{
            if( is_object( $this->result ) )
            {
                $this->result->free();
            }
			return false;
		}
		
		if( ! $this->link )
			$this->connect();
		
		$this->row = $result->fetch_assoc();
		return $this->row;
	}
	
	
	function fetch_row($arr)
	{
		$this->select(
			$arr['from'],
			$arr['select'],
			$arr['where'],
			$arr['order'],
			$arr['group'],
			$arr['limit'],
			$arr['count']
		);
		
		$row = $this->fetch();
		
		return $row;
		
	}
	
	function fetch_column($column, $arr)
	{
		$this->select(
			$arr['from'],
			$arr['select'],
			$arr['where'],
			$arr['order_tbl'],
			$arr['group'],
			$arr['limit'],
			$arr['count']
		);
		
		$this->fetch();
		
		return $this->row[ $column ];
	}
	
	function nextid()
	{
		return ($this->link) ? @mysql_insert_id($this->link) : false;
	}
	
	function row_count($input = '')
	{
		
		if( ! $input )
			$input = $this->result;
		
		if( is_resource( $input ) )
		{
			$this->row_count = mysql_num_rows( $input );
		}
		elseif( is_string( $input ) )
		{
			$this->query( $input );
			$this->row_count = mysql_num_rows( $this->result );
			
		}
		elseif( is_array( $input ) )
		{
			$this->build_run_query( $input );
			$this->row_count = mysql_num_rows( $this->result );
		}
		else
		{
			return false;
		}
		return $this->row_count;
	}
	
	function affected_rows()
	{
		if( ! $this->link )
		{
			return false;
		}
		
		return mysql_affected_rows( $this->link );
	}
	
	function row_exists($input)
	{
		if( is_array( $input ) )
		{
			$this->build_run_query( $input );
			
		}
		else
		{
			$this->query( $input );
		}
		
		if( $this->row_count() > 0 )
		{
			return true;
		}
		return false;
	}
	
	function escape($string)
	{
		if( preg_match("#`#", $string ) )
		{
			return $string;
		}
		
		return $this->db->real_escape_string($string);
	}
		
	function create_table( $a )
	{
		$a['table'] = $this->vars['pre'] . $a['table'];
		
		$sql = "CREATE TABLE IF NOT EXISTS `" . APP::cfg('db', 'name') . "`.`$a[table]`  (\n\t";
		foreach( $a['columns'] as $column )
		{
			
			$sql .= "`$column[name]` $column[type]";
			
			if( $column['length'] )
			{
				$sql.= "( $column[length] )";
			}
			
			if( $column['unsigned'] )
			{
				$sql .= " UNSIGNED";
			}
			
			
			if( $column['null'] == 1 )
			{
				$sql .= " NULL";
				$column['default'] = "NULL";
			}
			elseif( $column['null'] == 0 )
			{
				$sql .= " NOT NULL";
			}
			
			if( isset( $column['default'] ) )
			{
				if( empty( $column['default'] ) and ! is_numeric( $column['default'] ) )
				{
					$column['default'] = "''";
				}
				$sql .= " DEFAULT $column[default]";
			}
			
			if( $column['auto_increment'] )
			{
				$sql .= ' AUTO_INCREMENT';
			}
			$sql .= ",\n\t";
		}
		if( $a['primary'] )
		{
			$sql .= "PRIMARY KEY( `$a[primary]` )\n";
		}
		$sql .= ") ENGINE = $a[engine]";
		
		if( $a['collation'] )
		{
			$pre = preg_replace("#_.*#i", '', $a['collation'] );
			
			$sql .= " CHARACTER SET $pre COLLATE $a[collation]";
		}
		
		$sql .= ";";
		
		$this->query( $sql );
		
		if( ! $this->result )
			return false;
		
		return true;
	}
	
	function create_database( $db = '' )
	{
		if( ! $db )
			$db = AKZ::$settings['database']['name']; 
		
		//$db = $this->escape( $db );
		
		$this->query("CREATE DATABASE IF NOT EXISTS $db") or die( mysql_error() );
		
		if( ! mysql_select_db( $db, $this->link) )
		{
			ERROR::add(array(
				'key' => 'createdb',
				'file' => $_SERVER['SCRIPT_FILENAME'],
				'line' => $this->query_count,
				'str' => 'Could not create the database',
				'sender' => 'Database',
				'sql' => 'mysql_create_db: ' . $db, 
			));
		}
	}
	
	function close()
	{
		$cmd = false;
		
		if( $this->link )
			$cmd = @mysql_close( $this->link );
		
		$this->link = '';
			
		if( ! $cmd )
		{
			/*ERROR::add(array(
				'file' => $_SERVER['SCRIPT_FILENAME'],
				'line' => $this->query_count,
				'str' => 'mysql.class.php:destruct()::' . mysql_error(),
				'sender' => 'Database',
			));*/
		}
			
		return $cmd;
	}
	
	/**
	* Function for validating values
	* @access private
	*/
	function sql_validate_value($var)
	{
		if (is_null($var))
		{
			return 'NULL';
		}
		else if (is_string($var))
		{
			return "'" . $this->escape($var) . "'";
		}
		else
		{
			return (is_bool($var)) ? intval($var) : $var;
		}
	}
	
	/**
	* Build IN or NOT IN sql comparison string, uses <> or = on single element
	* arrays to improve comparison speed
	*
	* @access public
	* @param	string	$field				name of the sql column that shall be compared
	* @param	array	$array				array of values that are allowed (IN) or not allowed (NOT IN)
	* @param	bool	$negate				true for NOT IN (), false for IN () (default)
	* @param	bool	$allow_empty_set	If true, allow $array to be empty, this function will return 1=1 or 1=0 then. Default to false.
	*/
	function sql_in_set($field, $array, $negate = false, $allow_empty_set = false)
	{
		if (!sizeof($array))
		{
			if (!$allow_empty_set)
			{
				// Print the backtrace to help identifying the location of the problematic code
				$this->sql_error('No values specified for SQL IN comparison');
			}
			else
			{
				// NOT IN () actually means everything so use a tautology
				if ($negate)
				{
					return '1=1';
				}
				// IN () actually means nothing so use a contradiction
				else
				{
					return '1=0';
				}
			}
		}

		if (!is_array($array))
		{
			$array = array($array);
		}

		if (sizeof($array) == 1)
		{
			@reset($array);
			$var = current($array);

			return $field . ($negate ? ' <> ' : ' = ') . $this->sql_validate_value($var);
		}
		else
		{
			return $field . ($negate ? ' NOT IN ' : ' IN ') . '(' . implode(', ', array_map(array($this, 'sql_validate_value'), $array)) . ')';
		}
	}

	
	function __destruct()
	{
		$this->close();
	}
}
?>
