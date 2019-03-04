<?php 
    echo form_open(); 
        echo form_label('Tourcode :', 'spotcode');

        $attributes = array(
            'name' => 'spotcode',
            'placeholder' => 'Please Enter Tourcode',
            'class' => 'form-control',
        	'value' => $page['spotcode']
        );

        echo form_input($attributes);
        
        echo form_label('Title:', 'title');

        $attributes = array(
            'name' => 'title',
            'placeholder' => 'Please Enter Title',
            'class' => 'form-control',
        	'value' => $page['title']
        );
        
        echo form_input($attributes);

        echo form_label('Description:', 'description');

        $attributes = array(
            'name' => 'description',
            'placeholder' => 'Please Enter  Description',
            'class' => 'form-control',
            'value' => $page['dsc']
        );

        echo form_textarea($attributes);
        
        echo form_label('Cat_id:', 'cat_id');
            
        $attributes = array(
            'name' => 'cat_id',
            'class' => 'form-control ckeditor',
            'value' => $page['spot_category_id']
        );

        echo form_input($attributes);

        echo form_label(' Tage:', 'tage');

        $data= array(
            'name' => 'tage',
            'placeholder' => 'Please Enter  tage',
            'class' => 'form-control',
            'value' => $page['tags']
        );
        
        echo form_input($data);

        echo form_label('Sort_order:', 'sort_order');
        
        $data = array(
           'name' => 'sort_order',
           'placeholder' => 'Please Enter Sort_order',
           'class' => 'form-control',
           'value' => $page['sort_order']
        );

        echo form_input($data);

        $data = array(
            'name'          => 'sub',
            'id'            => 'sub',
            'value'         => 'Add',
            'type'          => 'submit',
            'content'       => 'Add',
            'class'         => "btn btn-primary"   
        );

        echo form_button($data);
	   
    echo form_close();
?>
