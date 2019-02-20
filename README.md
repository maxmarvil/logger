# logger  

Need tests


`
$logger = new Logger();
// or
$logger = new Logger('/log.txt);

// use
// set messag and write to file and print in browser
$logger->mess('Messag text')->toFile()->print();
// print stack trace
$logger->print();
// save stack trace
$logger->toFile('/log.log')
`
