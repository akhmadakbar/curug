<?php if(validation_errors()) { ?>
<div class="alert alert-warning">
<?php echo validation_errors(); ?>
</div>
<?php } ?>
 
 
<?php if($this->session->flashdata('item')) { ?>
<div class="alert alert-success">
<?php echo $this->session->flashdata('item'); ?>
</div>
<?php } ?>
 
 
<?php echo form_open(); ?>
 
  <div class="form-group">
    <?php echo form_label('Your Name','name'); ?>
    <?php echo form_input(array("class"=>"form-control","name" => "name", "placeholder"=>"Enter Name","value" => set_value('name'))); ?>
  </div>
  
  <div class="form-group">
    <?php echo form_label('Email address','EmailAddress'); ?>
    <?php echo form_input(array("class"=>"form-control","name" => "email", "placeholder"=>"Enter email","value" => set_value('email'))); ?>
  </div>
  
  <div class="form-group">
    <?php echo form_label('Phone Number','number'); ?>
    <?php echo form_input(array("class"=>"form-control","name" => "number", "placeholder"=>"Enter Phone Number","value" => set_value('number'))); ?>
  </div>
  
   <div class="form-group">
    <?php echo form_label('Subject','subject'); ?>
    <?php echo form_input(array("class"=>"form-control","name" => "subject", "placeholder"=>"Enter Subject","value" => set_value('subject'))); ?>
  </div>
  
   <div class="form-group">
    <?php echo form_label('Message','message'); ?>
    <?php echo form_input(array("class"=>"form-control","name" => "message", "placeholder"=>"Enter Message","value" => set_value('message'))); ?>
  </div>
  
  <button type="submit" class="btn btn-default">Submit</button>
<?php echo form_close(); ?>