<?php 
/**
 * defind class to execute task.
 */
include 'config.php';
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
	 * [get_data description]
	 * @param  [type] $limit [number to get record]
	 * @return [type]        [int]
	 */
	public function get_data($limit){
		$sql = "SELECT * FROM blogs limit ".$limit;
		$result = mysqli_query($this->__connect, $sql);
		return $result;
	}

	/**
	 * [get_one_data get one record]
	 * @param  [type] $id [id of blog]
	 * @return [type]     [int]
	 */
	public function get_one_data($id){
		$sql = "SELECT * FROM blogs WHERE id=".$id;
		$result = mysqli_query($this->__connect, $sql);
		return $result;
	}

}
?>