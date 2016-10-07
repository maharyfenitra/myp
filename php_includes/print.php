<script language="JavaScript">
var gAutoPrint = true; // Tells whether to automatically call the print function

function printSpecial() {

	if (document.getElementById != null) {

		var html_head = '<HTML>\n<HEAD>\n';
		var html = '\n';
		var html_hidden = '\n';
		var html_foot = '\n</BODY>\n</HTML>';

		if (document.getElementsByTagName != null) {
			var headTags = document.getElementsByTagName("head");
			if (headTags.length > 0)
				html_head += headTags[0].innerHTML;
		}

		html_head += '\n</HEAD>\n<BODY>\n';

		var printReadyElem = document.getElementById("printReady");
		var printReadyElemHidden = document.getElementById("printReadyHidden");

		if (printReadyElem != null) {
			html += printReadyElem.innerHTML;
		} else {
			alert("Could not find the printReady content");
			return;
		}

		if (printReadyElemHidden != null) {
			html_hidden += printReadyElemHidden.innerHTML;
		//	htmlHidden.style.display = "block";
		}

		html += '\n</BODY>\n</HTML>';

		var printWin = window.open("","printSpecial");
		printWin.document.open();
		printWin.document.write(html_head);
		printWin.document.write(html_hidden);
		printWin.document.write(html);
		printWin.document.write(html_foot);
		printWin.document.close();
		if (gAutoPrint) {
			printWin.print();
		}
	} else {
		alert("The print ready feature is only available if you are using a modern browser. Please update your browswer.");
	}
}

</script>
