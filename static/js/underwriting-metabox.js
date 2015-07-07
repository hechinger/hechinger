jQuery(document).ready(function($){
	$('#underwritingdiv .selectit input').on('change', function(){
		$('#underwritingdiv .selectit input').not(this).attr('checked', false);
	});
});		

