<?php
	$config = array(

			'signup' => array(

					array(
						'field' => 'up_username',
						'label' => 'Username',
						'rules' => 'required|is_unique[accounts.username]'
					),

					array(
						'field' => 'up_password',
						'label' => 'Password',
						'rules' => 'required|matches[up_confirm_password]'
					),

					array(
						'field' => 'up_confirm_password',
						'label' => 'Confirm',
						'rules' => 'required'
					),

					array(
						'field' => 'up_question',
						'label' => 'Security Question',
						'rules' => 'required'
					),

					array(
						'field' => 'up_answer',
						'label' => 'Answer',
						'rules' => 'required'
					),

				), // end signup

			'update' => array(

					array(
						'field' => 'up_username',
					)

				)

		); // end $config
?>