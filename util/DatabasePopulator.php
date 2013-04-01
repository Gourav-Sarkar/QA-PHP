<?php

/*
 * Database Populator 0.1a
 * @Author : Gourav Sarkar
 * @E-mail: Gourav.sarkar13@gmail.com
 * 
 * This simple class is solely for testing purpose. It was QUICKLY (in urgency) done for populating
 * database for another project. This class was written for specific scenario for
 * that project, so it may or may not suitable for your use. It is not either optimised
 * or ensure data intigration by any mean.It does not follow any security measures. 
 * As it is not intenendent for production or public facing
 * site. it should be only use to dump data in local server for development purpose. 
 * Dumped data supposed to be trucated before deploying in
 * production
 * 
 * Use at your own risk. I am not responsible for any
 * kind of data lose.
 * 
 * What does it do and dont?
 * Currently it does check the table and populate with appropiate data
 * It maintains foreighn key reference automatically
 * It does take full space in column
 *
 * @TODO
 * Handle dependency, (many to many relation) every entry ahs an reference in foreign table
 * 
 * and open the template in the editor.
 */
require_once 'DatabaseHandle.php';
class DatabasePopulator
{
    const DUMMY_STRING = <<<'NDC'
    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam nibh. Nunc varius facilisis eros. Sed erat. In in velit quis arcu ornare laoreet. Curabitur adipiscing luctus massa. Integer ut purus ac augue commodo commodo. Nunc nec mi eu justo tempor consectetuer. Etiam vitae nisl. In dignissim lacus ut ante. Cras elit lectus, bibendum a, adipiscing vitae, commodo et, dui. Ut tincidunt tortor. Donec nonummy, enim in lacinia pulvinar, velit tellus scelerisque augue, ac posuere libero urna eget neque. Cras ipsum. Vestibulum pretium, lectus nec venenatis volutpat, purus lectus ultrices risus, a condimentum risus mi et quam. Pellentesque auctor fringilla neque. Duis eu massa ut lorem iaculis vestibulum. Maecenas facilisis elit sed justo. Quisque volutpat malesuada velit.

Nunc at velit quis lectus nonummy eleifend. Curabitur eros. Aenean ligula dolor, gravida auctor, auctor et, suscipit in, erat. Sed malesuada, enim ut congue pharetra, massa elit convallis pede, ornare scelerisque libero neque ut neque. In at libero. Curabitur molestie. Sed vel neque. Proin et dolor ac ipsum elementum malesuada. Praesent id orci. Donec hendrerit. In hac habitasse platea dictumst. Aenean sit amet arcu a turpis posuere pretium.

Nulla mauris odio, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit posuere. Aliquam erat volutpat. Cras lobortis orci in quam porttitor cursus. Aenean dignissim. Curabitur facilisis sem at nisi laoreet placerat. Duis sed ipsum ac nibh mattis feugiat. Proin sed purus. Vivamus lectus ipsum, rhoncus sed, scelerisque sit amet, ultrices in, dolor. Aliquam vel magna non nunc ornare bibendum. Sed libero. Maecenas at est. Vivamus ornare, felis et luctus dapibus, lacus leo convallis diam, eget dapibus augue arcu eget arcu.

Fusce auctor, metus eu ultricies vulputate, sapien nibh faucibus ligula, eget sollicitudin augue risus et dolor. Aenean pellentesque, tortor in cursus mattis, ante diam malesuada ligula, ac vestibulum neque turpis ut enim. Cras ornare. Proin ac nisi. Praesent laoreet ante tempor urna. In imperdiet. Nam ut metus et orci fermentum nonummy. Cras vel nunc. Donec feugiat neque eget purus. Quisque rhoncus. Phasellus tempus massa aliquet urna. Integer fringilla quam eget dolor. Curabitur mattis. Aliquam ac lacus. In congue, odio ut tristique adipiscing, diam leo fermentum ipsum, nec sollicitudin dui quam et tortor. Proin id neque ac pede egestas lacinia. Curabitur non odio.

Nullam porta urna quis mauris. Aliquam erat volutpat. Donec scelerisque quam vitae est. Aenean vitae diam at erat pellentesque condimentum. Duis pulvinar nisl sed orci. Vivamus turpis nisi, volutpat in, placerat et, pharetra nec, eros. Suspendisse tellus metus, sodales non, venenatis a, ultrices auctor, erat. In ut leo nec elit mattis pellentesque. Sed eros elit, cursus accumsan, sollicitudin a, iaculis quis, diam. Pellentesque fermentum, pede a nonummy varius, ligula velit laoreet erat, et lacinia nibh nulla sit amet nunc. Suspendisse at turpis quis augue pellentesque pretium. Nunc condimentum elit semper felis.

Duis imperdiet diam pharetra nisi. Fusce accumsan. Fusce adipiscing, felis non ornare egestas, risus elit placerat mauris, in mollis ante erat quis nisi. Quisque sed ipsum. Nulla facilisi. Donec arcu erat, sodales quis, cursus eget, posuere eget, tellus. Vestibulum eu risus. Curabitur adipiscing, odio in pretium feugiat, nulla magna vehicula lorem, at placerat tortor nisl eget velit. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse mollis fermentum massa.

Pellentesque vulputate bibendum lorem. Nunc lobortis. Vestibulum aliquam fringilla mauris. Vivamus dolor est, eleifend id, varius id, suscipit at, felis. Nulla mattis cursus neque. Nam lobortis mi vitae sem vehicula accumsan. Integer vitae odio in felis facilisis cursus. Sed bibendum mauris a justo. Integer ut mi. Maecenas quis mauris. Integer non lectus at magna elementum posuere.

Vestibulum et urna. Aliquam pretium, urna nec dapibus vehicula, tellus nulla pretium dolor, vitae gravida massa erat non mauris. Aenean non erat. Nam non leo. Fusce sed erat. Maecenas id odio vehicula eros elementum congue. Donec feugiat orci in lectus. Vestibulum mattis justo eget justo. Aenean eu nisl. Phasellus non ipsum non nisi fringilla cursus. Integer condimentum porta arcu. Quisque faucibus. Quisque mattis, tellus eu auctor pulvinar, nulla dui sagittis elit, vel ultricies mauris lectus tempus magna. Donec auctor facilisis lorem. Ut pharetra pellentesque nulla. Phasellus libero metus, commodo sit amet, ullamcorper sit amet, euismod et, tortor. Sed nec arcu et felis vulputate venenatis.

Praesent sagittis, justo id malesuada tincidunt, ipsum leo elementum risus, at pulvinar ante urna et sem. Proin posuere metus sed tellus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Vivamus eros. Mauris tincidunt congue nunc. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean porttitor ante vitae ligula. Duis mattis diam id mi. Nulla sed mi ut elit bibendum pharetra. Aenean eu nunc. Integer lacus sem, feugiat nec, lacinia non, adipiscing sit amet, odio. Etiam odio. Maecenas placerat placerat libero. Donec ultricies erat vitae tellus volutpat fringilla. Phasellus urna est, tincidunt at, porta vitae, viverra ut, lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Cras non odio viverra libero eleifend sagittis.

Aliquam dictum lectus. Morbi pulvinar lacus et diam. Maecenas nunc massa, ultrices eget, nonummy nec, condimentum et, risus. Proin convallis dapibus nisi. Maecenas porta, augue quis porttitor consectetuer, felis odio blandit orci, in elementum pede lacus egestas mi. Etiam auctor, mauris eget lobortis blandit, tellus nisl convallis turpis, non auctor ante nisl eget eros. Donec rhoncus purus nec nunc. Suspendisse eros. Fusce et nisl. Morbi condimentum enim sed ipsum. Aliquam mi. Duis sit amet sapien. Nullam sed purus. Aliquam fringilla sagittis neque. Fusce eget risus. Donec bibendum, purus id bibendum sagittis, mauris est tincidunt risus, nec fermentum diam velit pellentesque dolor. Vestibulum quis libero eget arcu vestibulum auctor. Donec sit amet erat. Maecenas sit amet ipsum. Pellentesque sapien pede, mollis a, consectetuer sit amet, consectetuer nec, tellus.

Duis ac est rutrum urna venenatis auctor. Sed quis ante. Nullam urna lorem, tempus eget, sollicitudin vitae, porta pharetra, eros. Aliquam sit amet eros. Curabitur ultricies imperdiet elit. Aenean lectus justo, eleifend bibendum, convallis eu, fermentum eu, magna. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. In odio leo, adipiscing a, pellentesque ac, aliquam sed, diam. Cras convallis rhoncus metus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi convallis massa quis justo. Nam sollicitudin ipsum eu justo. Suspendisse libero risus, ornare non, ultricies ac, mattis eget, dolor. In dignissim orci ut lectus.

Aliquam tincidunt justo tempor enim. Phasellus ac urna. Phasellus tortor. Morbi sit amet nibh. Pellentesque rutrum. Duis metus sem, posuere eget, feugiat ac, nonummy in, magna. Aliquam sit amet leo in nunc laoreet laoreet. Aenean ultrices. Donec tellus diam, sodales lacinia, facilisis vel, accumsan vel, sapien. Aliquam erat volutpat. Cras augue. Donec facilisis lorem ac ligula. Phasellus sed magna vitae nulla nonummy feugiat. Aenean et erat. Nulla sollicitudin interdum nibh.

Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam ultricies justo non leo venenatis accumsan. Sed eget leo. Etiam vel odio quis ligula imperdiet viverra. Fusce congue orci nec leo. Morbi pede sem, facilisis a, egestas nec, faucibus a, quam. Praesent lacus. Sed vel urna. Vestibulum tincidunt libero in justo. Donec non velit eget felis consequat congue. Donec id urna. Fusce dapibus consectetuer velit.

Ut metus. Maecenas dapibus nibh eu est. Proin faucibus pharetra nibh. Integer aliquet tellus in felis. Quisque mi pede, imperdiet a, dapibus vel, bibendum rhoncus, nulla. Sed eu velit. Maecenas molestie, ipsum nec nonummy mattis, ipsum lectus imperdiet nibh, sit amet accumsan nunc nunc et lorem. Quisque at augue. Donec elit ligula, pellentesque id, feugiat sed, malesuada a, turpis. Donec nunc quam, commodo ut, venenatis ut, feugiat quis, tortor. Nunc id risus vestibulum turpis facilisis fringilla. Pellentesque turpis ipsum, ultrices at, consequat sit amet, sollicitudin at, pede. Suspendisse potenti. Fusce eu ante sit amet lacus cursus tempor. Donec bibendum, metus nec tristique mollis, metus felis pellentesque sapien, eu mattis turpis lorem quis quam. In ligula nibh, varius quis, elementum sed, pellentesque vel, lectus. Praesent erat orci, hendrerit bibendum, tristique et, consectetuer eget, elit. Mauris vel mi at dui commodo elementum.

Cras ut ante et est elementum tristique. Curabitur pulvinar massa in tellus. Nullam eu massa. Etiam nulla. Sed in dui. Curabitur eleifend leo sit amet lorem vehicula venenatis. Mauris suscipit purus vitae dui. Suspendisse augue nunc, pellentesque id, euismod nec, elementum ut, arcu. Etiam ipsum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas a est sed justo porttitor fringilla. Pellentesque facilisis. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.

Morbi lectus quam, sollicitudin eget, pretium nec, consectetuer posuere, tellus. Nullam et diam. Mauris aliquam mollis est. Nullam egestas odio in sapien. Etiam leo tellus, vulputate sed, imperdiet vitae, faucibus vitae, sem. In ut elit non ante volutpat fermentum. Sed tempor sapien quis arcu. Praesent in lectus ultricies massa scelerisque convallis. Suspendisse a ante. Cras commodo, sem ac ullamcorper ornare, nibh diam placerat turpis, vitae faucibus dui orci ac ante. Curabitur orci ipsum, luctus at, scelerisque id, ultrices tempus, augue. Ut ut metus. Vivamus sed quam. Quisque augue nibh, rutrum quis, adipiscing quis, tincidunt ac, ligula. Integer vel pede sit amet nulla cursus ultricies.

Vestibulum tincidunt. Nam varius. Cras eros. Suspendisse vestibulum, leo eu tincidunt faucibus, nibh turpis cursus dui, eget mollis dui lacus quis diam. Quisque ultrices vehicula felis. Vivamus nec felis dapibus eros ultricies volutpat. Curabitur enim nisi, lobortis a, imperdiet ac, imperdiet quis, purus. Donec rhoncus lorem at eros. Nulla placerat nibh. Duis commodo odio a nunc. Donec congue. Phasellus quam magna, eleifend sed, pharetra non, vehicula eget, leo. Morbi vitae est id erat blandit fringilla. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.

Aenean eget justo eget mi facilisis tempor. Aliquam libero quam, facilisis eu, eleifend nec, congue in, turpis. Nulla vestibulum, est et commodo dapibus, eros risus pulvinar diam, sed accumsan dolor pede porta diam. Vivamus iaculis metus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed lacus. Sed vel mi. Vestibulum eget massa. Pellentesque libero justo, consequat nec, sodales vel, fringilla semper, diam. Donec at est. Cras dictum enim posuere tellus. Integer pharetra nulla non sapien. Maecenas sem velit, feugiat at, fermentum nec, pretium ac, lorem. Duis luctus, risus non sollicitudin gravida, felis quam pharetra tellus, in pellentesque dui ante at magna. Cras non diam et tortor ultricies pharetra. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean rutrum mauris et dolor. Etiam turpis sapien, fermentum et, auctor vel, elementum eu, leo.

Proin at ipsum tincidunt odio faucibus rutrum. Vestibulum tincidunt magna ut est. Mauris sollicitudin dignissim ligula. Quisque tortor orci, ullamcorper sit amet, rhoncus a, ultricies nec, nunc. Mauris molestie nunc vitae neque. Integer nulla. Proin vel eros. Suspendisse sed mi. Sed bibendum, sem in vehicula pellentesque, nulla leo tempus enim, at fringilla orci lacus in lorem. Vestibulum ante felis, pretium ut, condimentum sed, condimentum sagittis, libero. Curabitur vehicula. Aenean iaculis, ipsum quis ullamcorper facilisis, justo nisl sodales felis, eu dictum felis metus quis nunc. Cras imperdiet pede sed mi. Sed nisl magna, pellentesque sed, consequat et, suscipit ac, nisl. Quisque lectus ante, congue sed, viverra nec, scelerisque vel, lorem. Ut ac nisl ut mi congue interdum. Morbi eget risus. Nullam cursus. Maecenas volutpat, est ut adipiscing pretium, dolor velit nonummy ligula, at venenatis risus metus luctus elit.

Suspendisse congue nunc nec tortor. Suspendisse consectetuer. Pellentesque eros augue, consequat ac, tristique non, adipiscing vitae, sapien. Aenean fermentum convallis elit. In hac habitasse platea dictumst. Vivamus sodales dolor nec enim molestie dictum. Cras lobortis, urna suscipit mattis ultricies, quam massa auctor augue, et ullamcorper diam augue at eros. Donec pharetra purus eget ante. Morbi nisl. Curabitur vestibulum ipsum. Fusce arcu. Nunc tempor placerat nunc. Cras sed tortor. 
NDC;

    const DUMMY_INT="";
    
    private $fields;
    private $con;
    private $reference;
    private $table;
    
    public function __construct($table) 
    {
        DatabaseHandle::setDatabaseName("information_schema");
        $this->con=  DatabaseHandle::getConnection();
        $this->table=$table;
        
        //Get information of table fields
    }
    
    private function parseFields()
    {
        $query=  "SELECT 
                column_name
                ,data_type 
                ,column_key
                ,extra
                ,column_default
                ,is_nullable
                FROM columns WHERE table_name=?
                ORDER BY ordinal_position ASC
                ";
        $stmt=$this->con->prepare($query);
        $stmt->execute([$this->table]);
        
        $this->fields=$stmt->fetchAll(PDO::FETCH_ASSOC);
        
        //var_dump($this->fields);
                
    }
    
    private function parseReference()
    {
        
        $query=  "SELECT 
                referenced_column_name AS columnName
                ,referenced_table_name AS tableName
                ,referenced_table_schema AS databaseName
                ,column_name
                FROM key_column_usage
                WHERE table_name=? AND referenced_table_name IS NOT NULL
                ";
        $stmt=$this->con->prepare($query);
        $stmt->execute([$this->table]);
        
        $dataset=$stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($dataset as $data)
        {
            $prefValue=[];
            
            //echo "d";
            /* Connect to database depending upon the referenced column data
             * Database could be different so it is move on to loop
             */
            DatabaseHandle::setDatabaseName($data['databaseName']);
            $this->con=DatabaseHandle::getConnection();
        
            /*
             *  get all data from table and id
             * reference have value column table
             */
            $query="SELECT {$data['columnName']} FROM {$data['tableName']}";
            $stmt=$this->con->query($query);
            
            while($refData=$stmt->fetch(PDO::FETCH_NUM))
            {
                $prefValue[]=$refData[0];
            }
            
            $this->reference[$data['column_name']] = ['table'=>$data['tableName']
                                                            ,'column'=>$data['columnName']
                                                            ,'preferredValue'=>$prefValue
                                                        ];
            
                                                        
            
        }
        
         var_dump($this->reference);
        
    }
    
    private function prepare()
    {
        /*
         * Prepare for insert
         * take each column
         */
        
        foreach($this->fields as &$field)
        {
            $prefValue=[];
            /*
             * Possible values
             * dependent on data type of column
             * If it has default value or null randomize the data with data typed data
             * if it has reference replace the default value
             * 
             * $fieldMeta['possibleValue']
             */
          
            //$possibleValues[$field];
            //echo $field['column_name'];
            if(array_key_exists($field['column_name'], $this->reference))
            {
                //Has reference, except refference it can be null if data type has is_null
                //echo "Has reference";
                //var_dump($this->reference);
                
                $field['prefferedValue'] =  $this->reference[$field['column_name']]['preferredValue'];
                
            }
            else
            {
                //It has no referrence check data type and populate
            }
            
            /*
             * If it accpts null add it to preffered value
             */
            if($field['is_nullable']=='YES')
            {
                $field['prefferedValue']=array_merge($field['prefferedValue'],[NULL]);
            }
            
            //var_dump($prefValue);
            //var_dump($rt);
            
        }
    }
    
    public function getData()
    {
        
        $value=[];
        
        foreach($this->fields as $field)
        {
            //has reference
            if(isset($field['prefferedValue']))
            {
                $value[]=  $field['prefferedValue'][array_rand($field['prefferedValue'])];
                //echo $value;
            }
            else
            {
                //has no reference
                //check data type and dump data
                if(strstr($field['data_type'],'char') || strstr($field['data_type'],'text'))
                {
                    //split any random text from the dummy text
                    $letterToal=  strlen(static::DUMMY_STRING);
                    //echo $letterToal;
                    $start=rand(0,$letterToal);
                    $end=rand(0,$letterToal);
                    //end must be minimum half of column data length
                    
                    $value[]=substr(static::DUMMY_STRING, $start, $end);
                }
                else
                {
                    $value[] = rand(0,50000000);
                }
            }
            
            //retuen column name and value
            var_dump($field['column_name'] , $value);
        }
        var_dump($this->fields);
        
        //return sprintf("(%s)",implode(',' ,$value));
        
        return $value;
    }
    
    public function populate($numRows=1)
    {
        $values=[];
        
        $this->parseFields();
        $this->parseReference();
        $this->prepare();
        
        /*
         * prepare a placholder for field 
         */
        $placeholders =array_fill(0, count($this->fields), '?');
        $multiPlaceholderArray = array_fill(0, $numRows, sprintf("(%s)" , implode(',' , $placeholders)));
        
        while($numRows>=1)
        {
            //prepareValues
            $values =  array_merge($values , $this->getData());
            
            --$numRows;
        }
        
        $query= sprintf("INSERT IGNORE INTO %s VALUES %s" , $this->table , implode(',', $multiPlaceholderArray));
        //
        echo $query;
        
        var_dump($values);
        $this->con->prepare($query)->execute($values);
        
    }
}
/*
set_time_limit(0);
$rows=20000;
$dbPop= new DatabasePopulator("question");
$dbPop->populate($rows);

$dbPop= new DatabasePopulator("tagQuestionMapper");
$dbPop->populate($rows*3);

$dbPop= new DatabasePopulator("answer");
$dbPop->populate($rows);

$dbPop= new DatabasePopulator("answerComment");
$dbPop->populate($rows);

$dbPop= new DatabasePopulator("questionComment");
$dbPop->populate($rows);

 */
?>
