function overlay(mode) {
	if(mode == 'display') {
		if(document.getElementById("overlay") === null) {
			div = document.createElement("div");
			div.setAttribute('id', 'overlay');
			div.setAttribute('className', 'overlayBG');
			div.setAttribute('class', 'overlayBG');


			lightBox = document.createElement('div');
			lightBox.setAttribute('id', 'lightBox');

			span = document.createElement('span');
			span.setAttribute('class', 'pointer');
			span.setAttribute('className', 'pointer');
			span.setAttribute('onclick', 'overlay(\'none\')');
			text = document.createTextNode('close');
			
			p = document.createElement('p');
			p.setAttribute('class', 'pointer');
			p.setAttribute('className', 'pointer');
			p.setAttribute('onclick', 'overlay(\'none\')');
			text = document.createTextNode('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis. ');
			span.appendChild(text);
			lightBox.appendChild(span);
			
			p.appendChild(text);
			lightBox.appendChild(p);

			document.getElementsByTagName("body")[0].appendChild(div);
			document.getElementsByTagName("body")[0].appendChild(lightBox);
		}
	} else {
		document.getElementsByTagName("body")[0].removeChild(document.getElementById("overlay"));
		document.getElementsByTagName("body")[0].removeChild(document.getElementById("lightBox"));
	}
