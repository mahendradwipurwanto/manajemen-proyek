const tabs = document.querySelectorAll(".tab-mobile");
tabs.forEach((clickedTab) => {
	clickedTab.addEventListener('click', () => {
		tabs.forEach((tab => {
			tab.classList.remove("active");
		}))
		clickedTab.classList.add("active");
	});
});