<?php echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'); ?>
<script type="text/javascript">
var searchData = "false";
$(document).ready(function doRefresh() {
	$(document).on('click', '#pagination-container a', function () {
		var thisHref = $(this).attr('href');
		if (!thisHref) {
			return false;
		}
		$('#pagination-container').fadeTo(300, 0);
		console.log("mega");
		console.log(searchData);
		$('#pagination-container').load(thisHref, {search: searchData}, function() {
			$(this).fadeTo(200, 1);
		});
		return false;
	});
});
function search(){
	var searchUrl = <?php echo json_encode($this->Url->build([
		'action' => 'test2',
		'_ext' => 'html'])); ?>;
	$.ajax({
        type:"POST",
        url: searchUrl,
        dataType: 'html',
        data: {search: "true",},
        success: function(tab){
       	  searchData = "true";
          console.log(searchData);
          $('#pagination-container').fadeTo(300, 0);
          $('#pagination-container').html(tab);
          $('#pagination-container').fadeTo(200, 1);
          console.log('TEST2');
        },
        error: function (response) {
            console.log(response);
            alert('error');
        }
      });
}
</script>

<div class="page index">

<div id="pagination-container">
<?php 
	echo $this->element('../Export/ajax_table_part');
	
?>
</div>
<?php
echo $this->Form->button('search', array('id' => 'submitButton', 'type' => 'button', 'onClick' => 'search()'));
?>
</div>
