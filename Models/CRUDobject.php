<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Exception/noEntryFoundException.php';

/**
 * Description of CRUDobject
 * @todo Create function to parse structure of object
 * @todo Parse availble fields from field cache
 * @todo Parse result set and map to object structure to create a object
 * @todo Add auto creeation of model table
 * @author Gourav Sarkar
 */
class CRUDobject implements CRUDLInterface {
    //put your code here

    const QFRAG_IDF_MAIN = 'main';
    const QFRAG_IDF_LIMIT = 'limit';
    const QFRAG_IDF_PAGER = 'pager';
    const QFRAG_IDF_WHERE = 'where';
    const TYPE_IDF = '@type';
    const COMP_IDF = 'rootClass';
    const DATA_IDF = '@data';

    /*
     * Generic getter method to get instance of any class which have used this trait
     * get All fields
     * 
     */

    protected $fieldCache = array();
    protected $dependency;

    public function __construct(CRUDLInterface $obj) {
        $this->dependency = $obj;
    }

    public function setFieldCache($field) {
        //echo "<b>" . __METHOD__. "</b>";
        //var_dump($field);
        //Only one value can exist. if there is already a cache dont include it

        if (!in_array($field, $this->fieldCache) && is_string($field)) {
            $this->fieldCache[] = strtolower($field);
        }
    }

    public function create() {
        //var_dump(__METHOD__);
        /*
         * if fieldcache is null try to insert all row
         */

        //Initialize $data
        $data = '';

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
        //var_dump($this->fieldCache);
        $fieldCache = array_flip($this->fieldCache);
        //walk through array and set value by the key name
        array_walk($fieldCache, function(&$value, $key) {
                    /* get id of objects who have an private identifier
                     * Could be constrained to an interface or abstract class Later
                     */
                    $conjObj = $this->dependency->{"get{$key}"}();
                    if (is_object($conjObj)) {
                        if ($conjObj instanceof AbstractMap)
                            assert('!is_null($conjObj->getID())');
                        $value = $conjObj->getID();
                    } else {
                        $value = $conjObj;
                    }
                }
        );

        var_dump($fieldCache);
        //var_dump(static::$connection);

        $data = implode(',', array_map(function($key) {

                            return "{$key}=:{$key}";
                        }
                        , array_keys($fieldCache)
                )
        );



        //var_dump($data);
        $query = sprintf("INSERT INTO %s SET $data", (string) $this->dependency, $data);
        $stmt = DatabaseHandle::getConnection()->prepare($query);
        //var_dump($fieldCache);
        //var_dump($query);
        /*
         * Handle Abstract Map
         * "mapClassName"
         */
        /*
          if ($this->dependency instanceof AbstractMap) {
          foreach ($fieldCache as $idf => $val) {
          var_dump($idf,$val);
          $stmt->bindValue(":$idf", $val->getID());
          }
          } else {
         */
        foreach ($fieldCache as $idf => $val) {
            //var_dump(":$idf=>$val");
            $stmt->bindValue(":$idf", $val);
        }
        //}
        //echo $stmt->queryString;
        $retVal = $stmt->execute();

        //Ensures format last inserted ID
        //Dont use setter method because it does not needed to be cached for re database entry
        //$this->setID(static::$connection->lastInsertId());
        $this->dependency->setID(DatabaseHandle::getConnection()->lastInsertId());


        //unset fieldCache after each CRUDE operation
        $this->fieldCache = array();
    }

    /*
     * @PARAM AbstractContent $object is template of object which will be used to compare
     * Which object should be updated
     * 
     * 
     */

    public function edit(DatabaseInteractbleInterface $tempObj) {

        $data = $condition = '';
        /*
         * Go through the data
         * Check if it is valid identifier ot not
         * Update object
         * Make data for query
         */
        //$query=sprintf("UPDATE %s SET %s %s",get_class($this),$data,$condition);
        //Flip array
        //var_dump($this->fieldCache);
        $fieldCache = array_flip($this->fieldCache);
        //walk through array and set value by the key name
        array_walk($fieldCache, function(&$value, $key) {
                    /* get id of objects who have an private identifier
                     * Could be constrained to an interface or abstract class Later
                     */
                    if (is_object($conjObj = $this->dependency->{"get{$key}"}())) {
                        $value = $conjObj->getID();
                    } else {
                        $value = $this->dependency->{"get{$key}"}();
                    }
                }
        );

        //var_dump($fieldCache);
        //var_dump(static::$connection);

        $data = implode(',', array_map(function($key) {

                            return "{$key}=:{$key}";
                        }
                        , array_keys($fieldCache)
                )
        );



        $query = sprintf("UPDATE %s SET %s WHERE id=:id", get_class($this->dependency), $data);
        $stmt = DatabaseHandle::getConnection()->prepare($query);

        /*
         * @DEBUG Field debugging
         */
        foreach ($fieldCache as $idf => $val) {
            //var_dump(":$idf=>$val");
            $stmt->bindValue(":$idf", $val);
        }

        /*
         * $tempObj is template for updating
         * If $temobj is not there AKA NULL use objects id
         * ensure id is there
         */

        if (isset($tempObj)) {
            $stmt->bindValue(":id", $tempObj->getID());
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
        //var_dump($stmt->queryString);


        /*
         * unset fieldCache after each CRUDE operation
         */
        $this->fieldCache = array();

        /*
         * Execute query
         */
        return $stmt->execute();
    }

    /*
     * previously Set properties will be used as condition of deletion
     *
     */

    public function delete() {
        //assert("!empty($this->getID()); ");


        $condition = '';
        $params = array();
        /*
         * Go through the data
         * Check if it is valid identifier ot not
         * Update object
         * Make data for query
         */
        //$query=sprintf("DELETE FROM %s WHERE %s",get_class($this),$condition);
        //Flip array
        $fieldCache = array_flip($this->fieldCache);
        //var_dump($this->fieldCache);
        //var_dump($fieldCache);
        //walk through array and set value by the key name
        array_walk($fieldCache, function(&$value, $key) {
                    /* get id of objects who have an private identifier
                     * Could be constrained to an interface or abstract class Later
                     */
                    if (is_object($conjObj = $this->dependency->{"get{$key}"}())) {

                        $value = $conjObj->getID();
                    } else {
                        $value = $this->dependency->{"get{$key}"}();
                        //var_dump($value);
                    }
                }
        );

        //var_dump($fieldCache);
        //var_dump(static::$connection);

        $data = implode(' AND ', array_map(function($key) {

                            return "{$key}=:{$key}";
                        }
                        , array_keys($fieldCache)
                )
        );


        //var_dump($data);

        $query = sprintf("DELETE FROM %s WHERE %s", get_class($this->dependency), $data);
        $stmt = DatabaseHandle::getConnection()->prepare($query);

        //var_dump($fieldCache);

        foreach ($fieldCache as $idf => $val) {
            //var_dump(":$idf=>$val");
            //$stmt->bindValue(":$idf",$val);
            $params[":$idf"] = $val;
        }


        //var_dump($stmt->queryString);

        $this->fieldCache = array();
        return $stmt->execute($params);
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
     *  @tODO IF $reference is empty it means that class has not any associates and softread()==read();
     * 
     * @limitation Joined queries are outer join
     *  
     */

    public function read() {

        //var_dump('Object strcut',$this->dependency->getStrcuture());

        $reference = array();
        //echo __CLASS__;
        //var_dump($this);
        $query = sprintf("SELECT * FROM %s ", (string) $this->dependency);
        $refObj = new ReflectionClass((string) $this->dependency);
        //var_dump($refObj);
        $refProps = $refObj->getProperties(ReflectionProperty::IS_PRIVATE | ReflectionProperty::IS_PROTECTED);
        //var_dump($refProps);
        foreach ($refProps as $property) {
            $property->setAccessible(true);
            $value = $property->getValue($this->dependency);
            //Ensure it is object and is type of database interactble
            if ($value instanceof DatabaseInteractbleInterface) {
                //name and type of class
                //It will help to map the data pulled from database
                $reference[$property->getName()] = get_class($value);

                //Prepare query
                $query .= sprintf("LEFT OUTER JOIN %s AS %s ON %s.%s=%s.%s ", $reference[$property->getName()] //table name
                        , $reference[$property->getName()] //alias
                        , (string) $this->dependency                   //self
                        , $property->getName()               //field
                        , $reference[$property->getName()]   //Reference table/class
                        , 'id'              //field of reference table/class
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

        //If there is any conditional structute
        if (!empty($this->fieldCache)) {

            $query.=" WHERE ";

            $fieldCache = array_flip($this->fieldCache);

            foreach ($fieldCache as $field => &$value) {
                $value = $this->dependency->{"get{$field}"}();
                if ($value instanceof AbstractContent) {
                    $value = $value->getID();
                }
                $placeholders[] = "$this->dependency.$field=:$field ";

                //var_dump($field);
            }
            $query .= implode(" AND ", $placeholders);
        }

        /*
         * @DEBUG
         */
        /*
          echo $query;
          var_dump($fieldCache);
         * 
         */

        //var_dump($fieldCache);
        //var_dump($query);

        $stmt = DatabaseHandle::getConnection()->prepare($query);
        $stmt->execute($fieldCache);

        if (!$data = $stmt->fetch(PDO::FETCH_NUM)) {
            throw new NoEntryFoundException("No entry in Database");
        }



        //var_dump($data);
        //go through the data and map
        foreach (range(0, $stmt->columnCount() - 1) as $columnIndex) {


            $meta = $stmt->getColumnMeta($columnIndex);
            //echo "it is column {$meta['name']} of  {$meta['table']} <br/>";

            $tableStructure[$meta['table']][$meta['name']] = $data[$columnIndex];
            //var_dump($meta);
        }

        //Debug Mapped table Strcutre
        //var_dump($tableStructure);
        //Evaluate the object
        foreach ($tableStructure as $tableName => $table) {
            //var_dump($tableName);
            foreach ($table as $column => $value) {
                //Unreferenced property handle
                if ($tableName == (string) $this->dependency) {
                    if (!in_array($column, array_keys($reference))) {
                        //var_dump($column);
                        if (method_exists($this->dependency, "set{$column}")) {
                            $this->dependency->{"set{$column}"}($value);
                        } else {
                            trigger_error("[API] Setter method unavailble for property '$column' of object '{$this->dependency}'");
                        }
                    }
                } else {
                    //skip it if $table is empty
                    //assert(empty($table['id']));
                    //tablename is class name
                    //echo "table $tableName";
                    $referenceColumn = array_search($tableName, $reference);

                    //Tables can be returened empty ensures only data added table got passed for evaluation
                    if (!empty($table['id'])) {
                        //echo "ref col" . $referenceColumn;

                        $tempObj = $this->dependency->{"get{$referenceColumn}"}();
                        if (method_exists($tempObj, "set{$column}")) {
                            /*
                             * @TODO undefined method means undefined property or both
                             * Handle those error as Development Errors
                             */
                            $tempObj->{"set{$column}"}($value);
                        }
                    } else {
                        //Table is returned empty no need for initiated object
                        $this->dependency->{"set{$referenceColumn}"}(null);
                    }
                }
            }
        }


        //unset fieldCache after each CRUDE operation
        $this->fieldCache = array();
        return $this->dependency;
    }

    public function softRead() {
        $query = sprintf("SELECT * FROM %s ", get_class($this->dependency));

        //If there is any conditional structute
        if (!empty($this->fieldCache)) {

            $query.=" WHERE ";

            $fieldCache = array_flip($this->fieldCache);

            foreach ($fieldCache as $field => &$value) {
                $value = $this->dependency->{"get{$field}"}();
                $placeholders[] = " $field=:$field ";
            }
            $query .= implode(" AND ", $placeholders);
        }


        // echo $query;
        // var_dump($fieldCache);

        $stmt = DatabaseHandle::getConnection()->prepare($query);
        $stmt->execute($fieldCache);


        //var_dump($stmt->fetchAll(PDO::FETCH_ASSOC));
        //var_dump($data);

        if (!$data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            throw new NoEntryFoundException("No entry in Database");
        }

        //var_dump($data);
        /*
         * Initialize self
         */
        $class = new ReflectionClass($this->dependency);
        $properties = $class->getProperties(ReflectionProperty::IS_PRIVATE | ReflectionProperty::IS_PROTECTED);

        foreach ($properties as $property) {
            $property->setAccessible(true);
            $name = $property->getName();
            $value = $property->getValue($this->dependency);

            //echo "init $name value $value<br/>";

            /*
             *  Property either will be complex data type or promitive data type
             * If value is object it suppose to be initiated as object
             */
            if (is_object($value)) {
                if ($value instanceof AbstractContent && $name != 'dependency') {
                    $this->dependency->{"get{$name}"}()->setID($data[$name]);
                }
            } else {
                //echo "init $name<br/>";
                if (isset($data[$name])) {
                    $this->dependency->{"set{$name}"}($data[$name]);
                }
            }
        }

        $this->fieldCache = array();
        //var_dump('Db',$this);
        return $this->dependency;
    }

    public static function Listing(DatabaseInteractbleInterface $reference, $args = array()) {

        /*
         * @todo
         * Change to autoated initializing
         */
        $query[static::QFRAG_IDF_LIMIT] = '';
        $query[static::QFRAG_IDF_MAIN] = '';
        $query[static::QFRAG_IDF_WHERE] = '';

        $fields = array();
        $tables = array();
        $sqlRowCal = '';
        //var_dump($reference);

        $dataStructure[static::DATA_IDF] = CRUDobject::makeStructure($reference);
        $dataStructure[static::TYPE_IDF] = (string) $reference;


        //USORT failed
        /*
          var_dump($dataStructure);

          $sort = function($a, $b) {
          if (is_array($a) && is_array($b)) {
          uasort($a, $sort);
          uasort($b, $sort);
          return 0;
          } else {

          if (is_array($a)) {
          uasort($a, $sort);
          return 1;
          } elseif (is_array($b)) {
          uasort($b, $sort);
          return -1;
          }
          }

          return 0;
          };

          uasort($dataStructure, $sort);

         * 
         */
        //var_dump($dataStructure);
        $fields = CRUDobject::extractFields($dataStructure, (string) $reference);
        //var_dump($fields);
        //var_dump($dataStructure);
        $tables = CRUDobject::extractTableRelation($dataStructure, (string) $reference);
        //var_dump($tables);


        /*
         * Adds limit clause
         */
        if (!empty($args['pager']) && $args['pager'] instanceof Pagination) {
            $sqlRowCal = 'SQL_CALC_FOUND_ROWS';
            $query[static::QFRAG_IDF_LIMIT] = sprintf("limit %s,%s", $args['pager']->getOffset(), $args['pager']->getLimit());
        }


        $query['main'] = sprintf("SELECT %s %s FROM %s AS %s"
                , $sqlRowCal
                , implode(',', $fields)
                , (string) $reference
                , (string) $reference
        );

        /*
         * If there is any asscociated table include it
         */
        if (!empty($tables)) {
            $query['main'] = sprintf('%s %s', $query['main'], implode(',', $tables));
        }
        //LEFT OUTER JOIN ['tableNamae] AS ['alias]


        return $query;
    }

    private static final function makeStructure(DatabaseInteractbleInterface $obj) {


        $dataStructure = array();

        $reflectReferenceObject = new ReflectionObject($obj);
        $refProps = $reflectReferenceObject->getProperties(ReflectionProperty::IS_PRIVATE | ReflectionProperty::IS_PROTECTED);

        foreach ($refProps as $property) {
            $property->setAccessible(true);
            $name = $property->getName();
            $value = $property->getValue($obj);

            if ($value instanceof DatabaseInteractbleInterface) {
                $dataStructure[$name][static::DATA_IDF] = CRUDobject::makeStructure($value);
                //Object type
                $dataStructure[$name][static::TYPE_IDF] = (string) $value;
            } elseif (!is_object($value)) {
                $dataStructure[] = $name;
            }
        }

        return $dataStructure;
    }

    private static function extractFields(array $datastruct, $namespace) {
        $tables = array();
        $fields = array();

        //static $currentTable = 'default';

        /*
          array_walk_recursive($fields
          , function($value,$key) use($fs)
          {
          //$data=reset($key);
          var_dump("{$key}_{$value}");
          }
          );
         * 
         */

        foreach ($datastruct[static::DATA_IDF] as $name => $component) {
            //var_dump($datastruct);
            if (is_array($component)) {
                //prepare fields
                //Walk through all element and prepend alias aka variable name to them
                //var_dump($datastruct);
                //$currentTable = $name;

                $fields = array_merge($fields, CRUDobject::extractFields($component, $name));
            } else {
                //Identifier_property_class
                $fields[] = "{$namespace}.{$component} AS {$namespace}_{$component}_{$datastruct[static::TYPE_IDF]}";
            }
        }
        /*
         */

        //var_dump($fields);

        sort($fields, SORT_STRING);

        return $fields;
    }

    /*
     * @todo handle invisible 
     */

    private static function extractTableRelation(array $datastructure, $namespace) {


        $query = '';
        $queryFrag = "LEFT OUTER JOIN %s AS %s
            ON %s=%s  
            ";
        $tables = array();

        foreach ($datastructure[static::DATA_IDF] as $name => $component) {
            if (is_array($component)) {
                //prepare fields
                //Walk through all element and prepend alias aka variable name to them
                //var_dump($datastruct);
                //$currentTable = $name;

                $query[] = sprintf($queryFrag
                        , $component[static::TYPE_IDF] //table name
                        , $name                         //table alias
                        , "{$namespace}.{$name}"            //first table FK
                        , "{$component[static::TYPE_IDF]}.id"   //second table FK
                );

                static::extractTableRelation($component, $name);


                //var_dump($component);
            }
        }

        //var_dump($query);

        return $query;
    }

    public static function map($data) {
        $stacks = array();

        //var_dump('data' , $data);
        foreach ($data as $name => $value) {
            list($identifier, $property, $className) = explode('_', $name);

            //var_dump($identifier, $className, $property);

            /*
             * Decrease use call of reflection by making it conditional and caching it
             */
            if (empty($stacks['object']) || !array_key_exists($identifier, $stacks['object'])) {
                $stacks['object'][$identifier] = new $className();
                $stacks['reflection'][$identifier] = new ReflectionObject($stacks['object'][$identifier]);
            }

            //Debug
            //var_dump("set{$property}");

            if (method_exists($stacks['object'][$identifier], "set{$property}")) {
                /*
                 * Uses setter method for object creation
                 * @issues populates field cache of crudobject too
                 * @beinifit possibly faster
                 */
                //var_dump("verified set{$property} $value");
                $stacks['object'][$identifier]->{"set{$property}"}($value);
                //var_dump("Stack" ,$stacks['object'][$identifier]);
                //Uses reflection to set up a object
                /*
                  $reflProp = $stacks['reflection'][$identifier]->getProperty($property);
                  $reflProp->setAccessible(true);
                  $reflProp->setValue($stacks['object'][$identifier], $value);
                 */
            } else {
                throw new BadMethodCallException("$property does not exist");
            }

            //$classes[]=new $className();
        }
        //var_dump('total', count($stacks['object']));

        return $stacks['object'];
    }

    /*
     * It will return current object or object list
     * If $id is null List out all the data and return a objectstorage
     * IF $id is valid object use it as reference which will help to use condition
     * 
     * Only modify object itself if ID is specified. All DatabaseIntereactbleInterface have ID attribute, so thus AbstractContent
     * 
     */

    /*
      public function get() {

      $id = $reference->getID();
      if (!empty($id)) {
      //Modify itself
      } else {
      //return list
      }
      }
     *
     */

    /*
     * Recursively insert object into database
     * Check the object strcuture
     * Measure the changed property
     * Aggregate the objects to combine insertion
     * Recursively call Create()
     */
    /*
      public function insert()
      {

      }
     * 
     */
}

?>
