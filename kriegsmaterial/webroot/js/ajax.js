function search(){
        console.log("Been here");
        var targetUrl = <?php echo $this->Html->url(array('action' => 'search', 'ext' => 'json')); ?>;
        //var targetUrl = <?php echo $this->Url->build(['action'=>'search']);?>;
        console.log(targetUrl);
       $.ajax({
                type:"POST",
                url: targetUrl,
                dataType: 'text',
                success: function(tab){
                    alert('success');
                },
                error: function (tab) {
                    alert('error');
                }
        });

}
