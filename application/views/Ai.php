
<?php $pspell = pspell_new('en','canadian','','utf-8',PSPELL_FAST);

function spellCheckWord($word) {
    global $pspell;
    $autocorrect = TRUE;

    // Take the string match from preg_replace_callback's array
    $word = $word[0];
   
    // Ignore ALL CAPS
    if (preg_match('/^[A-Z]*$/',$word)) return $word;

    // Return dictionary words
    if (pspell_check($pspell,$word))
        return $word;

    // Auto-correct with the first suggestion, color green
    if ($autocorrect && $suggestions = pspell_suggest($pspell,$word))
        return '<span style="color:#00FF00;">'.current($suggestions).'</span>';
   
    // No suggestions, color red
    return '<span style="color:#FF0000;">'.$word.'</span>';
}

function spellCheck($string) {
    return preg_replace_callback('/\b\w+\b/','spellCheckWord',$string);
}

echo spellCheck('PHP is a reflecktive proegramming langwage origenaly dezigned for prodewcing dinamic waieb pagges.');
?>

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
