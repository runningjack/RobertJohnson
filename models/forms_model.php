<?php
				class forms_Model extends Model{
					
					function __construct(){
						parent::__construct();
						
					}
					
					function createCV(){
						$error = "";
						$cv = new CV();
						if(isset($_POST['fname']) && !empty($_POST['fname'])){
							$cv->cv_fname = $_POST['fname'];
						}else $error .= "First Name ";
						
						if(isset($_POST['lname']) && !empty($_POST['lname'])){
							$cv->cv_lname = $_POST['lname'];
						}else $error .= "Last Name ";
						
						if(isset($_POST['email']) && !empty($_POST['email']) && checkEmail($_POST['email']) == true){
							$cv->cv_email = $_POST['email'];
						}else $error .= "Email ";
						
						if(isset($_POST['phone']) && !empty($_POST['phone']) && checkPhone($_POST['phone']) == true){
							$cv->cv_phone = $_POST['phone'];
						}else $error .= "Phone Number ";
						
						if(isset($_POST['role']) && !empty($_POST['role'])){
							$cv->cv_role = $_POST['role'];
						}
												
						$preferred = "";
						for($i =1; $i <=38; $i++){
							$checkbox = "cb".$i;
							if(isset($_POST[$checkbox])){
								$preferred .= $_POST[$checkbox].", ";	
							}
						}
						if($preferred == ""){
							$cv->cv_preferred = "Any";
						}
						else $cv->cv_preferred = $preferred;
						
						$upload = $this->upload_cv();
						if($upload != 3 && $upload != 2){
							$cv->cv_doc_path = $upload;	
						}elseif($upload == 1){
							$error .= "Document Upload Problem "; 	
						}elseif($upload == 2){
							$error .= "File type not acceptable ";
						}
						
						if($error == ""){
							if($cv->create()){
								return 1;
							}
							else return 2;
						}
						else return $error;
					}
					
					function upload_cv(){
						$ext = pathinfo($_FILES['cv']['name'],PATHINFO_EXTENSION);
						if($ext == 'pdf' || $ext == 'doc' || $ext == 'docx'	&& ($_FILES['cv']['size']) <= 4096000){
								$custom_name = rand(3, 500)."_".time();
								$filepath = $custom_name.'.'.$ext;
								if(move_uploaded_file($_FILES["cv"]["tmp_name"], "public/upload/".$filepath)){
									return $filepath;
								}
								else return 2;
							}
						else return 3;
					}
					
					function addContact(){
						$error = "";
						$contact = new Contact();
						if(isset($_POST['name']) && !empty($_POST['name'])){
							$contact->c_name = $_POST['name'];
						}else $error .= "Name ";
						
						if(isset($_POST['email']) && !empty($_POST['email']) && checkEmail($_POST['email']) == true){
							$contact->c_email = $_POST['email'];
						}else $error .= "Email ";
						
						if(isset($_POST['phone']) && checkPhone($_POST['phone']) == true){
							$contact->c_phone = $_POST['phone'];
						}else $error .= "Phone Number ";
						
						if(isset($_POST['comment']) && !empty($_POST['comment'])){
							$contact->c_comment = $_POST['comment'];
						}else $error .= "No Comment ";
						
						if($error == ""){
							if($contact->create()){
								return 1;	
							}else return 2;
						}else return $error;
					}
					
					function getCategoryWeb(){
						if(isset($_POST['cat_id'])){
							$category = Category::find_by_id($_POST['cat_id']);
							return $category;
						}
					}
					
					function getProductWeb(){
						if(isset($_POST['prod_id'])){
							$product = Product::find_by_id($_POST['prod_id']);
							return $product;
						}
					}
					
				}
				?>