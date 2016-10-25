<h1>Hello!. please ask your question.</h1>
<form action="" method="post" >
	Your Question:
	<input type="text" name="question" value="<?php echo $result['question']; ?>"  size="40"/>
	<?php if($result['answer']!='false'){ ?>
		Answer:
		<input type="text" name="answer" value="<?php echo $result['answer']; ?>"/> 
	<?php }else{ ?>
		I dont know the answer for this question. Can you please Tell me the answer.<br>
		Your Answer:
		<input type="text" name="answer" value=""/> 
	<?php } ?>
	<br><input type="submit" name="save" value="Submit Query" />
</form>
