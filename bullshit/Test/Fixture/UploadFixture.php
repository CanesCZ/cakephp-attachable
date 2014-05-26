<?php

class UploadFixture {

	public $incompleteUpload = array(
		'Attachment' => array(
			'files' => array(
				array(
					'name' => 'partial_upload.jpg',
					'type' => 'image/jpg',
					'tmp_name' => 'somewhere_somehow',
					'error' => UPLOAD_ERR_PARTIAL,
					'size' => 555,
				)
			)
		)
	);
	
	public $okUpload = array(
		'Attachment' => array(
			'files' => array(
				array(
					'name' => 'partial_upload.jpg',
					'type' => 'image/jpg',
					'tmp_name' => 'somewhere_somehow',
					'error' => UPLOAD_ERR_OK,
					'size' => 555,
				)
			)
		)
	);
	
	public $multipleUploadOk = array(
		'Attachment' => array(
			'files' => array(
				array(
					'name' => 'partial_upload.jpg',
					'type' => 'image/jpg',
					'tmp_name' => 'somewhere_somehow',
					'error' => UPLOAD_ERR_OK,
					'size' => 555,
				),
				array(
					'name' => 'partial_upload.jpg',
					'type' => 'image/jpg',
					'tmp_name' => 'somewhere_somehow',
					'error' => UPLOAD_ERR_OK,
					'size' => 555,
				)
			)
		)
	);
	
	public $multipleUploadBroken = array(
		'Attachment' => array(
			'files' => array(
				array(
					'name' => 'partial_upload.jpg',
					'type' => 'image/jpg',
					'tmp_name' => 'somewhere_somehow',
					'error' => UPLOAD_ERR_OK,
					'size' => 555,
				),
				array(
					'name' => 'partial_upload.jpg',
					'type' => 'image/jpg',
					'tmp_name' => 'somewhere_somehow',
					'error' => UPLOAD_ERR_PARTIAL,
					'size' => 555,
				),
				array(
					'name' => 'cant_write_err.jpg',
					'type' => 'image/jpg',
					'tmp_name' => 'somewhere_somehow',
					'error' => UPLOAD_ERR_CANT_WRITE,
					'size' => 555,
				)
			)
		)
	);

}
