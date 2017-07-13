<?php 
/**
 * defind class to execute task.
 */
include 'Config.php';
class BlogAstract extends Config{
	protected $title;
	protected $content;
	
	public function __construct(){
		Config::connect();
	}

	/**
	 * [setTitle set title for blog]
	 * @param [type] $title [string]
	 */
	public function setTitle($title){
		$this->title= $title;
	}

	public function setContent($content){
		$this->content= $content;
	}

	/**
	 * check title uniquie
	 * @param  [type] $column  [name of column]
	 * @param  [type] $content [content want to check]
	 */
	
	public function check($column,$content){
		$sql = "SELECT * FROM blogs WHERE ".$column."='".$content."'";
		$result = mysqli_query($this->__connect, $sql);
		if (mysqli_num_rows($result) > 0) {
			return false;
		}
		return true;
	}

	/**
	 * [add_record add a blog record]
	 */
	public function add_record(){
		if($this->check('title',$this->title)==false){
			return;
		}
		$sql = "INSERT INTO blogs (title,content,time_created) VALUES ('".$this->title."','".$this->content."','".microtime(true)."')";
		if (mysqli_query($this->__connect, $sql)) {
		    return 1;
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($this->__connect);
		}
	}

	/**
	 * [get_list this is function to get data from table]
	 * @param  [type]  $where [ int or array]
	 * @param  integer $limit [int/ to get number of record]
	 * @param  integer $page  [int/ page want to get]
	 * @return [type]         [array]
	 */
	function get_list($where = NULL, $limit = 0, $page = 0) {
        $sqlStr = "SELECT * FROM blogs ";
        $sql = '';
        $sqllimit = '';
        if (is_array($where)) {
        	$sql = ' AND ';
            foreach ($where as $key => $value) {  
            	if(is_string($value)){
            		$sql .= $key."= '". $value."'";
            	}else{
            		$sql .= $key."=". $value;
            	}                  
            	
            }
        }
	    if(!isset($_SESSION["username"]) || $_SESSION["username"] != 'admin'){ 
	        $sql .= ' AND showed=1';
        }

        if ($limit && $page) {
            $sqllimit = " limit ".$limit * ($page-1).",".$limit;
        }
        $sqlStr .= ' WHERE 0=0 '.$sql.' '.$sqllimit;
        // echo $sqlStr;die;
        $result = mysqli_query($this->__connect, $sqlStr);
		return $result;
    }
    /**
     * [get_total_page get total of page]
     * @param  [type] $limit [int]
     * @return [type]        [int]
     */
	public function get_total_page($limit){
		if(!isset($_SESSION["username"]) || $_SESSION["username"] != 'admin'){
			$sql = "SELECT * FROM blogs WHERE showed=1";
		}
		else{
			$sql = "SELECT * FROM blogs";
		}
		$result = mysqli_query($this->__connect, $sql);
		return ceil(mysqli_num_rows($result)/$limit);
	}

	/**
	 * [get_one_data get one record]
	 * @param  [type] $id [id of blog]
	 * @return [type]     [array]
	 */
	public function get_one_data($id){
		$sql = "SELECT * FROM blogs WHERE id=".$id;
		$result = mysqli_query($this->__connect, $sql);
		return $result;
	}
	/**
	 * [show_blog admin can use]
	 * @param  [type] $id [int]
	 * @return [type]     [true]
	 */
	public function show_blog($id){
		$sql = "UPDATE blogs SET showed=1 WHERE id=".$id;
		$result = mysqli_query($this->__connect, $sql);
		return $result;
	}
}
?>