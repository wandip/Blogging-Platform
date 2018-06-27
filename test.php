<?php

$text = "Man must explore, and this is exploration at its greatest | Problems look mighty small from 150 miles up | Never in all their history have men been able truly to conceive of the world as one: a single sphere, a globe, having the qualities of a globe, a round earth in which all the directions eventually meet, in which there is no center because every point, or none, is center â€” an equal earth which all men occupy as equals. The airman's earth, if free men make it, will be truly round: a globe in practice, not in theory.

Science cuts two ways, of course; its products can be used for both good and evil. But there's no turning back from science. The early warnings about technological dangers also come from science.

What was most significant about the lunar voyage was not that man set foot on the Moon but that they set eye on the earth.

A Chinese tale tells of some men sent to harm a young girl who, upon seeing her beauty, become her protectors rather than her violators. That's how I felt seeing the Earth for the first time. I could not help but love and cherish her.

For those who have seen the Earth from space, and for the hundreds and perhaps thousands more who will, the experience most certainly changes your perspective. The things that we share in our world are far more valuable than those which divide us.

[h]The Final Frontier[/h]

There can be no thought of finishing for â€˜aiming for the stars.â€™ Both figuratively and literally, it is a task to occupy the generations. And no matter how much progress one makes, there is always the thrill of just beginning.

There can be no thought of finishing for â€˜aiming for the stars.â€™ Both figuratively and literally, it is a task to occupy the generations. And no matter how much progress one makes, there is always the thrill of just beginning.

[q]The dreams of yesterday are the hopes of today and the reality of tomorrow. Science has not yet mastered prophecy. We predict too much for the next year and yet far too little for the next ten.[\q]

Spaceflights cannot be stopped. This is not the work of any one man or even a group of men. It is a historical process which mankind is carrying out in accordance with the natural laws of human development.

[h]Reaching for the Stars[/h]

As we got further and further away, it [the Earth] diminished in size. Finally it shrank to the size of a marble, the most beautiful you can imagine. That beautiful, warm, living object looked so fragile, so delicate, that if you touched it with a finger it would crumble and fall apart. Seeing this has to change a man.

[i]figname[/i]
[c]To go places and do things that have never been done before â€“ thatâ€™s what living is all about.[/c]

Space, the final frontier. These are the voyages of the Starship Enterprise. Its five-year mission: to explore strange new worlds, to seek out new life and new civilizations, to boldly go where no man has gone before.

As I stand out here in the wonders of the unknown at Hadley, I sort of realize thereâ€™s a fundamental truth to our nature, Man must explore, and this is exploration at its greatest.

Placeholder text by [l http://google.com]Space Ipsum[/l]. Photographs by [l http://google.com]NASA on The Commons.[/l]";
require_once('php/Database.php');
require_once('php/Credentials.php');

$db = new Db(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
// var_dump($db);

// echo $site_title;

$query = "insert into Posts values (?,?,?,?,?,?,?)";
$resut = $db->updateSql($query, array(1, 3, "Failure is not an option", "Many say exploration is part of our destiny, but it’s actually our duty to future generations.", $text, "post-bg", "April 5, 2018"), $response);

// var_dump($result);

// $user_id = $response[0]['user_id'];


 ?>
