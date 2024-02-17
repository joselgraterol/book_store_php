
let navbar = document.querySelector(".header .navbar")
let userBox = document.querySelector(".header .user-box")

document.querySelector("#menu-btn").onclick = () => {
	navbar.classList.toggle("active")
	userBox.classList.remove("active")

}

document.querySelector("#user-btn").onclick = () => {
	userBox.classList.toggle("active")
	navbar.classList.remove("active")
}

window.onscroll = () => {
	navbar.classList.remove("active")
	userBox.classList.remove("active")

	if (window.scrollY > 60) {
		document.querySelector(".header .header-1").classList.add("active")
	}else{
		document.querySelector(".header .header-1").classList.remove("active")
	}
}