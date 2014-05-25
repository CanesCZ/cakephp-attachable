<?php
class Attachment extends Model {
	
	private $settings = array(
		
	);
	public $validate = array(
		'files' => array(
			'rule' => 'noUploadError',
		)
	);
	
	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		$this->settings['uploadDir'] = WWW_ROOT . DS . 'files' . DS . 'uploads' . DS;
	}

/**
 * Checks for any upload error and tries to move file across system
 * so the upload will be successfull
 * 
 * @param array $options
 */
	public function noUploadError($check){
		$errMsg = '';
		foreach ($check['files'] as $file) {
			if ($file['error'] !== 0) {
				$errMsg .= '"'. $file['name'] .'": '. $this->uploadErrors[ $file['error'] ] ." \n";
			}
		}
		return empty($errMsg) ? true : $errMsg;
	}
	
/**
 * Prepares and gathers file info for saving
 * 
 * @param array $options
 */
	public function beforeSave($options = array()){
		
		foreach ($this->data['Attachment']['files'] as &$file) {
			
			print_r($this->RelatedModel->id);
			print_r($this->RelatedModel->alias);
			$file['parent_id'] = null;
			$file['parent_type'] = null;
			$file['user_id'] = $this->Auth->user('id');
			$file['type'] = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
			$file['name'] = pathinfo($file['name'], PATHINFO_FILENAME);
			$file['path'] = Inflector::slug($file['name']) . microtime() .'.'. $file['type'];
			
			if (!move_uploaded_file($file['tmp_name'], $this->settings['uploadDir'] . $file['path'])){
				return false;
			}
		}
		
		return true;
	}
	
/**
 * Maybe rename file so it corresponds with saved record
 * 
 * @param boolean $created
 * @param array $options
 */
	public function afterSave($created, $options = array()){
		
	}

	
	public function beforeDelete($cascade = true){
		if ($unlinkedFile) {
			return true;
		} else {
			return false;
		}
	}
	
	public $uploadErrors = array(
		UPLOAD_ERR_INI_SIZE => "Server nepřijme tak velký soubor.", 
		UPLOAD_ERR_FORM_SIZE => "Soubor je příliš velký.", 
		UPLOAD_ERR_PARTIAL => "Nepodařilo se nahrát celý soubor.", 
		UPLOAD_ERR_NO_FILE => "Soubor nenalezen.", 
		UPLOAD_ERR_NO_TMP_DIR => "Chybí složka pro dočasné soubory.", 
		UPLOAD_ERR_CANT_WRITE => "Nelze zapisovat na disk.", 
		UPLOAD_ERR_EXTENSION => "Neplatná přípona souboru.", 
	);

}
