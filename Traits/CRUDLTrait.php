<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CrudTrait
 * Used in self behaviour of CRUD
 * @author Gourav Sarkar
 */
trait CRUDLTrait{
    //put your code here
    /*
     * Generic getter method to get instance of any class which have used this trait
     * get All fields
     * 
     */
    protected $fieldCache=[];
    
    protected function setFieldCache($field)
    {
        //echo "<b>" . __METHOD__. "</b>";
        //var_dump($field);
        //Only one value can exist. if there is already a cache dont include it
        
        if(!in_array($field,$this->fieldCache) && is_string($field))
        {
            $this->fieldCache[]=  strtolower($field);
        }
    }
    
    
    public function create()
    {
        var_dump(__METHOD__);
         /*
         * if fieldcache is null try to insert all row
         */
        
        //Initialize $data
        $data='';
        
        //Debug statment
        //var_dump(array_flip($this->fieldCache));
       
      
        //var_dump($stmt);
        
        /*
         * Flip array. Swap key and value. field names are now key and value of it
         * will be property with same field name
         * getter method will be used to get data instead of direct access
         * Direct access will be problemetic (property access) it will also give last time
         * modification or filtering chance and will have constant use policy along the class
         * hieggherchy
         */
        //Flip array
        var_dump($this->fieldCache);
        $fieldCache=array_flip($this->fieldCache);
        //walk through array and set value by the key name
        array_walk($fieldCache,function(&$value,$key)
                                {
                                    /* get id of objects who have an private identifier
                                     * Could be constrained to an interface or abstract class Later
                                     */
                                    if(is_object($conjObj=$this->{"get{$key}"}()))
                                    {
                                        $value=$conjObj->getID();
                                    }
                                    else 
                                    {
                                        $value=$this->{"get{$key}"}();
                                    }
                                }
                   );
                   
         var_dump($fieldCache);
        //var_dump(static::$connection);
        
        $data=implode(',' ,array_map(function($key){
                            
                                            return "{$key}=:{$key}";
                                        }
                                        ,array_keys($fieldCache)
                                     )
                     );       
        
                                        
        var_dump($data);
        $query=sprintf("INSERT INTO %s SET $data",get_class($this),$data);
        $stmt=static::$connection->prepare($query);
         var_dump($fieldCache);
        
         foreach($fieldCache as $idf=>$val)
        {
            var_dump(":$idf=>$val");
            $stmt->bindValue(":$idf",$val);
        }
        echo $stmt->queryString;
        $retVal=$stmt->execute();
        
        //Ensures format last inserted ID
        //Dont use setter method because it does not needed to be cached for re database entry
        //$this->setID(static::$connection->lastInsertId());
        $this->id=static::$connection->lastInsertId();
                
                
        //unset fieldCache after each CRUDE operation
        $this->fieldCache=[];
        return $retVal;
    }
    
    
    
    
    
    
    /*
    * @PARAM AbstractContent $object is template of object which will be used to compare
    * Which object should be updated
     * 
     * 
     */
    public function edit(DatabaseInteractbleInterface $tempObj)
    {
       
        $data=$condition='';
        /*
         * Go through the data
         * Check if it is valid identifier ot not
         * Update object
         * Make data for query
         */
        //$query=sprintf("UPDATE %s SET %s %s",get_class($this),$data,$condition);
        
        //Flip array
        $fieldCache=array_flip($this->fieldCache);
        //walk through array and set value by the key name
        array_walk($fieldCache,function(&$value,$key)
                                {
                                    /* get id of objects who have an private identifier
                                     * Could be constrained to an interface or abstract class Later
                                     */
                                    if(is_object($conjObj=$this->{"get{$key}"}()))
                                    {
                                        $value=$conjObj->getID();
                                    }
                                    else 
                                    {
                                        $value=$this->{"get{$key}"}();
                                    }
                                }
                   );
                   
         var_dump($fieldCache);
        //var_dump(static::$connection);
        
        $data=implode(',' ,array_map(function($key){
                            
                                            return "{$key}=:{$key}";
                                        }
                                        ,array_keys($fieldCache)
                                     )
                     );
                                        
        
        
        $query=sprintf("UPDATE %s SET %s WHERE id=:id",get_class($this),$data);
        $stmt= DatabaseHandle::getConnection()->prepare($query);
        
          
         foreach($fieldCache as $idf=>$val)
        {
            var_dump(":$idf=>$val");
            $stmt->bindValue(":$idf",$val);
        }
        
        /*
         * $tempObj is template for updating
         * If $temobj is not there AKA NULL use objects id
         * ensure id is there
         */
        
         if(isset($tempObj))
        {
            $stmt->bindValue(":id",$tempObj->getID());
        }
        
        /*
        else
        {
            $id=$this->getID();
            assert('isset($id)');
            $stmt->bindValue(":id",$id);
        }
         * 
         */
        
        
        /*
         * Debug statement
         */
        echo $stmt->queryString;
        
        
        /*
         * unset fieldCache after each CRUDE operation
         */
        $this->fieldCache=[];
        
        /*
         * Execute query
         */
        return $stmt->execute();
        
        
    }
    
    
    
    
    
    /*
     * previously Set properties will be used as condition of deletion
     *
     */
    public function delete()
    {
        //assert("!empty($this->getID()); ");
        
        
        $condition='';
        /*
         * Go through the data
         * Check if it is valid identifier ot not
         * Update object
         * Make data for query
         */
        //$query=sprintf("DELETE FROM %s WHERE %s",get_class($this),$condition);
        
        //Flip array
        $fieldCache=array_flip($this->fieldCache);
        
        //var_dump($fieldCache);
        
        //walk through array and set value by the key name
        array_walk($fieldCache,function(&$value,$key)
                                {
                                    /* get id of objects who have an private identifier
                                     * Could be constrained to an interface or abstract class Later
                                     */
                                    if(is_object($conjObj=$this->{"get{$key}"}()))
                                    {
                                        
                                       $value=$conjObj->getID();
                                    }
                                    else 
                                    {
                                        $value=$this->{"get{$key}"}();
                                        echo $value;
                                    }
                                }
                   );
                   
         var_dump($fieldCache);
        //var_dump(static::$connection);
        
        $data=implode(' AND ' ,array_map(function($key){
                            
                                            return "{$key}=:{$key}";
                                        }
                                        ,array_keys($fieldCache)
                                     )
                     );
                                        
        
        var_dump($data);
        
        $query=sprintf("DELETE FROM %s WHERE %s",get_class($this),$data);
        $stmt=static::$connection->prepare($query);
        
        //var_dump($fieldCache);
        
         foreach($fieldCache as $idf=>$val)
        {
            var_dump(":$idf=>$val");
            $stmt->bindValue(":$idf",$val);
        }
        
        
        echo $stmt->queryString;
        
        $this->fieldCache=[];
        return $stmt->execute();
    }
    
    
    
    
    
    
    /* 
     * ALGORITHM:
     * $id does not work
     * Reflection will only get referencing object
     * Mysql column meta data wil hold actual data (it will ensure not to pull unwanted data
     * 
     * Get properties of object
     * Get only private and protected property
     * Get table schema 
     * Get column name and table name
     * If properties are object it has reference to other class/table
     *      get the class name of referenced property
     *      get the property by getter method which will return object of that type
     *      use that object to initialize data which have the same table/class name
     *  If it is scalar type it is property of object
     * 
     *
     *  LOGIC:
     *  read() gets properties of object and decide how many of them represents
     *  other class in System. If a property is object it is by default represents 
     *  a class. to help ensure the class is meant to be used for database interaction
     *  DatabaseInteractbleInterface is used. Properties most of the time will private
     *  or protected which represents database field.
     * 
     *  It now get the referenced property and take account on them in $reference
     *  [Unimplemented] $referenced class also will be pulled recursively for getting
     *  Referenced object till it reaches the leaf node.
     * 
     *  Joins by default happens in calling id column of reference table
     *  
     *  Data will be filtered by calling objects id. read() always returns one object (Assert)
     * 
     *  Maintain read-only,write-only,read-write nature of the object. before calling
     *      appropiate setter or getter method ensure of existance of the method.Mapping
     *      will be based on object. Object will not be compromised to make access or evaluate the object
     *      When using read()
     *  
     *  Supports only LEFT OUTER JOIN. deep pulling of data [Need update]
     *  
     */
    public function read()
    {
            //echo __CLASS__;
            //var_dump($this);
        $query=sprintf("SELECT * FROM %s ",get_class($this));
        $refObj=new ReflectionClass(get_class($this));
        //var_dump($refObj);
        $refProps=$refObj->getProperties(ReflectionProperty::IS_PRIVATE | ReflectionProperty::IS_PROTECTED);
        //var_dump($refProps);
        foreach($refProps as $property)
        {
            $property->setAccessible(true);
            $value=$property->getValue($this);
            //Ensure it is object and is type of database interactble
            if($value instanceof DatabaseInteractbleInterface)
            {
                //name and type of class
                //It will help to map the data pulled from database
                $reference[$property->getName()]=get_class($value);
                
                //Prepare query
                $query .= sprintf("LEFT OUTER JOIN %s AS %s ON %s.%s=%s.%s ",
                                    $reference[$property->getName()] //table name
                                    ,$reference[$property->getName()] //alias
                                    ,get_class($this)                   //self
                                    ,$property->getName()               //field
                                    ,$reference[$property->getName()]   //Reference table/class
                                    ,'id'              //field of reference table/class
                                );
            }
            /*
            elseif($value instanceof SplObjectStorage)
            {
                echo "listing" . $property->getName();
            }
             * 
             */
            
        }
        
        //Append for reading specific element
        $query .= sprintf("WHERE %s.id=:id",get_class($this));
        
        
        //var_dump($reference);
        //var_dump($query);
        
        //Execute query
        $id=$this->getID();
        assert(!empty($id));
        
        $stmt=static::$connection->prepare($query);
        $stmt->bindValue(":id", $id);
        unset($id);
        
        //echo $query;
        $stmt->execute();
        
        if(!$data=$stmt->fetch())
        {
            throw new NoEntryFoundException("No entry in Database");
        }
        
        
        
        //var_dump($data);
        
        //go through the data and map
        foreach(range(0,$stmt->columnCount()-1) as $columnIndex)
        {
            
            
            $meta=$stmt->getColumnMeta($columnIndex);
            //echo "it is column {$meta['name']} of  {$meta['table']} <br/>";
             
             $tableStructure[$meta['table']][$meta['name']]=$data[$columnIndex];
            //var_dump($meta);
            
        }
        
        //Debug Mapped table Strcutre
        //var_dump($tableStructure);
        
        //Evaluate the object
        foreach($tableStructure as $tableName=>$table)
        {
            //var_dump($tableName);
           foreach($table as $column=>$value)
           {
                 //Unreferenced property handle
                 if($tableName==get_class($this))
                {
                    if(!in_array($column,array_keys($reference)))
                    {
                        //var_dump($column);
                        $this->{"set{$column}"}($value);
                    }
                    
                }
                else
                {
                    //skip it if $table is empty
                    //assert(empty($table['id']));
                    
                    //tablename is class name
                    //echo "table $tableName";
                    $referenceColumn=array_search($tableName,$reference);
                    
                    //Tables can be returened empty ensures only data added table got passed for evaluation
                    if(!empty($table['id']))
                    {
                        //echo "ref col" . $referenceColumn;
                    
                        $tempObj=$this->{"get{$referenceColumn}"}();
                        if(method_exists($tempObj, "set{$column}"))
                        {
                             $tempObj->{"set{$column}"}($value);
                        }
                    }
                    else
                    {
                        //Table is returned empty no need for initiated object
                        $this->{"set{$referenceColumn}"}(null);
                    }
                    
                    
                }
            }
           
        }
        
        
        //unset fieldCache after each CRUDE operation
        $this->fieldCache=[];
        return $this;
    }
    
    
    public function softRead()
    {
        $query=sprintf("SELECT * FROM %s ",  get_class($this));
        
        //If there is any conditional structute
        if(!empty($this->fieldCache))
        {
            
            $query.=" WHERE ";
        
            $fieldCache=array_flip($this->fieldCache);
        
            foreach($fieldCache as $field=>&$value)
            {
                $value=$this->{"get{$field}"}();
                $placeholders[]=" $field=:$field ";
            }
            $query .= implode(" AND " , $placeholders);
        }
        
        
        echo $query;
        var_dump($fieldCache);
        
        $stmt=static::$connection->prepare($query);
        $stmt->execute($fieldCache);
        
        
        //var_dump($stmt->fetchAll(PDO::FETCH_ASSOC));
        
        $data=$stmt->fetch(PDO::FETCH_ASSOC);
        var_dump($data);
        /*
         * Initialize self
         */
        $class= new ReflectionClass($this);
        $properties=$class->getProperties(ReflectionProperty::IS_PRIVATE | ReflectionProperty::IS_PROTECTED);
        
        foreach($properties as $property)
        {
            $property->setAccessible(true);
            $name=$property->getName();
            $value=$property->getValue($this);
            
            //echo "init $name value $value<br/>";
            
            /*
             *  Property either will be complex data type or promitive data type
             * If value is object it suppose to be initiated as object
             */
            if(is_object($value))
            {
                if($value instanceof AbstractContent)
                {
                    $this->{"get{$name}"}()->setID($data[$name]);
                }
            }
            else
            {
                 //echo "init $name<br/>";
                if(isset($data[$name]))
                 {
                    $this->{"set{$name}"}($data[$name]);
        
                }
            }
            
            
           
        }
        
        $this->fieldCache=[];
        //var_dump($this);
    }
    
   public static function Listing(DatabaseInteractbleInterface $reference)
   {
       
       
   }
    
    
    
}

?>
