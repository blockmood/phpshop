$('tr.tron').on('mouseover',function(){
	$(this).find('td').css('backgroundColor','#BBDDE5');
}).on('mouseout',function(){
	$(this).find('td').css('backgroundColor','#FFFFFF');
})