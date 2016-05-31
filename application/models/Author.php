<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Author extends CI_Model{
	
	public function getAllAuthors(){

		return $this->db->query("Select * from authors")->result_array();

	}

	public function writeAuthor($authorData)
	{
		$query = "INSERT INTO AUTHORS (name, created_at, updated_at)
				   VALUES (?,?,?)";

		$values = array(
			"name" => $authorData['author_name'],
			"created_at" => Date('Y-m-d H:i:s'),
			"updated_at" => Date('Y-m-d H:i:s')
			);

		if ($this->db->query($query, $values)===true){

			return $this->db->insert_id();

		}
		else
		{
			return(false);
		}
	}

}