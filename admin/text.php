<?php
 
$date = date("dmY");
$file_name = $date.".txt";
$file = fopen($file_name,'w+');
 
$string = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec mattis quam in nunc rutrum fermentum. Suspendisse mauris leo, sollicitudin id magna quis, faucibus pharetra velit. Nulla lacinia porttitor dolor eu venenatis. Duis suscipit magna vel nisi vehicula, quis sollicitudin lacus dapibus. Duis aliquet lorem id diam adipiscing scelerisque. Nulla pharetra turpis in elit luctus interdum. Etiam eget sapien at enim posuere iaculis. Nam lobortis ipsum nisi, nec pretium nisl cursus eget. Suspendisse faucibus, mi nec pharetra rutrum, justo nisl ultrices ligula, at convallis ligula nisi non nisi. Etiam varius convallis dui eget lacinia. Etiam dui sem, luctus ac scelerisque in, convallis eu magna. Ut eleifend purus non turpis auctor sollicitudin. Curabitur in dolor sed mauris malesuada vestibulum. Donec justo erat, rhoncus non tortor nec, varius consequat magna. Nunc tristique lacus id venenatis pulvinar. Mauris vel nisi lectus.
 
Sed condimentum commodo felis a iaculis. Vestibulum nec bibendum arcu. Proin facilisis sit amet enim et commodo. Donec gravida tortor eget lobortis varius. Donec at dolor a enim lacinia tempus. Vivamus id odio a nisl sagittis lacinia. Nulla rutrum tempus rutrum. Cras pulvinar neque ac interdum ullamcorper. Fusce turpis dolor, elementum quis magna quis, pharetra dapibus mauris. Maecenas auctor aliquam neque id euismod. Aliquam rhoncus, libero non vehicula faucibus, arcu leo pulvinar velit, a ornare erat lorem ac odio.";
 
fwrite($file,$string);

 
?>