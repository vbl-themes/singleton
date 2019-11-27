/*
 * Copyright 2019 by Baltnet Communications (https://www.baltnet.ee)
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *        http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

function changePic(section, idx) {
	if (section.tagName !== "SECTION") return;
	if (section.currentFigure === undefined) section.currentFigure = 0;

	for (let i = 0; i < section.children.length; i++) {
		section.children[i].className = "hidden";
		if (i === section.currentFigure) section.children[i].className = "";
	}

	section.currentFigure = (++section.currentFigure % section.children.length);
}

window.addEventListener('load', () => {
	const widgets = document.getElementsByClassName('widget_heroloop');
	for (let i = 0; i < widgets.length; i++) {
		window.setInterval(changePic, 5000, widgets[i]);
	}
});
