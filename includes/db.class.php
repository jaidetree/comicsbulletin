<?php
##########################################################################################
# NAME: Database Functions											        			 #
# DATE: 5.28.2009																		 #
# VERSION: 1.0																			 #
# AUTHOR: Jay [ Aetkinz Designs, Inc. ]												     #
#																						 #
# DESCRIPTION:																			 #
#   Handles all the main database functions						                         # 
##########################################################################################

class DataBase
{
	var $error 			= null;
	
	var $link 			= null;
    var $db             = null;
	
	
	var $skip_escapes 	= array();
	
	
	var $vars 			= array();
	
	var $query_count 	= 0;
	
	var $sql 			= '';
	var $result 		= null;
	var $row 			= null;
	
	var $auto_optomize 	= 1;
	
	
	function build_query($args)
	{
		if( $args['from'] )
			$args['table'] = $args['from'];

		if( $args['select'] )
		{
			if( count( $args['join'] ) )
				$this->start_select_join( $args['table'], $args['select'], $args['join'], $args['where'] );
			elseif( count( $args['joins'] ) )
				$this->start_select_join( $args['table'], $args['select'], $args['joins'], $args['where'] );
			else
				$this->start_select( $args['table'], $args['select'], $args['where'] );
		}
		
		if( $args['update'] and ! isset( $args['insert'] ) )
		{
			$this->start_update( $args['update'], $args['fields'], $args['where'] );
		}
		
		if( $args['insert'] and isset( $args['insert'] ) )
		{
			$args['data'] = ( $args['fields'] ) ? $args['fields'] : $args['data'];
			
			$this->start_insert( $args['insert'], $args['data'] );
		}
		
		if( $args['delete'] and isset( $args['delete'] ) )
		{
			$this->start_delete( $args['delete'], $args['where'] );
		}
		
		if( $args['group'] and isset( $args['group'] ) )
			$this->add_group( $args['group'] );
		
		if( $args['order'] and isset( $args['order'] ) )
			$this->add_order( $args['order'] );
			
		if( $args['limit'] and isset( $args['limit'] ) )
			$this->add_limit( $args['limit'] );
		
	}
	
	function build_fetch_query( $a )
	{
		$this->build_query( $a );
		$this->run_query();
		
		return $this->fetch();

	}
	
	function build_run_query( $a )
	{
		$this->build_query( $a );
		$this->run_query();
		
		return $this->result;

	}
	
	function run_query()
	{
		$result = $this->query( $this->sql );
		$this->sql = '';
		
		
		return $result;
	}
	
	function parse_value( $value )
	{
		if( is_numeric( $value ) and intval( $value ) == $value)
			return intval( $value );
		
		elseif( is_numeric( $value ) and floatval($value) == $value )
			return floatval( $value );
		
		elseif( strstr( $value, "`" ) )
			return $value;
		
		else
			return "'" . $value . "'";
	}
	
	function array2update($vars)
	{
		$return = '';
		foreach($vars as $field => $value)
		{
			if( ! $this->skip_escapes[ $field ] )
			{
				$value = $this->escape($value);
				$value = $this->parse_value( $value );
			}
			
			$return .= '`' . $field . '` = ';
			
			$return .= $value . ',';
		}
		
		$return = preg_replace( "/,$/", '', $return );
		return $return;
	}
	
	function array2insert($vars)
	{
		$cols = '';
		$vals = '';
		
		foreach($vars as $field => $value)
		{
			
			if( ! $this->skip_escapes[ $field ] )
			{
				$value = $this->escape( $value );
				$value = $this->parse_value( $value );
			}
			
			$cols .= "`$field`,";
			
			$vals .= $value . ",";
			
		
		}
		
		$cols = preg_replace( "/,$/", '', $cols);
		$vals = preg_replace( "/,$/", '', $vals);
		
		return "( $cols ) VALUES ( $vals )";
	}
	
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

			return $field . ($negate ? ' <> ' : ' = ') . $this->_sql_validate_value($var);
		}
		else
		{
			return $field . ($negate ? ' NOT IN ' : ' IN ') . '(' . implode(', ', array_map(array($this, '_sql_validate_value'), $array)) . ')';
		}
	}
	
	/**
	* Function for validating values
	* @access private
	*/
	function _sql_validate_value($var)
	{
		if (is_null($var))
		{
			return 'NULL';
		}
		else if (is_string($var))
		{
			return "'" . $this->sql_escape($var) . "'";
		}
		else
		{
			return (is_bool($var)) ? intval($var) : $var;
		}
	}
	
}
?>

