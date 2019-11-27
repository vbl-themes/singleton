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

function changeText(article, reverse = false) {
	if (article.tagName !== "ARTICLE") return;
	if (article.currentSlogan === undefined) article.currentSlogan = 0;

	article.currentSlogan = ((reverse ? article.currentSlogan - 1 : article.currentSlogan + 1) + article.children.length) % article.children.length;

	for (let i = 0; i < article.children.length; i++) {
		article.children[i].className = "hidden";
		if (i === article.currentSlogan) article.children[i].className = "";
	}
}

window.addEventListener('load', () => {
	const widgets = document.getElementsByClassName('widget_sloganloop');
	for (let i = 0; i < widgets.length; i++) {
		const article = widgets[i].getElementsByTagName("article");
		if (article.length !== 1) continue;
		window.setInterval(changeText, 5000, article[0]);
	}
});
