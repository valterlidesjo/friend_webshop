document.addEventListener("DOMContentLoaded", function () {
  const button = document.querySelector(".scroll-btn");

  button.addEventListener("click", function () {
    const targetElement = document.getElementById("more");

    targetElement.scrollIntoView({
      behavior: "smooth",
      block: "start",
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const navBtn = document.getElementById("menu-toggle");

  navBtn.addEventListener("click", function () {
    const navMenu = document.getElementById("nav-dropdown");
    if (navMenu.style.display === "block") {
      navMenu.classList.remove("open");
      navMenu.style.display = "none";
      navBtn.classList.remove("active");
    } else {
      navMenu.style.display = "block";
      navMenu.classList.add("open");
      navBtn.classList.add("active");
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const showPasswordBtn = document.getElementById("showPassword");
  const passwordInput = document.getElementById("password");
  showPasswordBtn.addEventListener("click", function () {
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      showPasswordBtn.classList.remove("fa-eye-slash");
      showPasswordBtn.classList.add("fa-eye");
    } else {
      passwordInput.type = "password";
      showPasswordBtn.classList.remove("fa-eye");
      showPasswordBtn.classList.add("fa-eye-slash");
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const showPasswordRepeatBtn = document.getElementById("showRepeatPassword");
  const passwordRepeatInput = document.getElementById("passwordRepeat");
  showPasswordRepeatBtn.addEventListener("click", function () {
    if (passwordRepeatInput.type === "password") {
      passwordRepeatInput.type = "text";
      showPasswordRepeatBtn.classList.remove("fa-eye-slash");
      showPasswordRepeatBtn.classList.add("fa-eye");
    } else {
      passwordRepeatInput.type = "password";
      showPasswordRepeatBtn.classList.remove("fa-eye");
      showPasswordRepeatBtn.classList.add("fa-eye-slash");
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  let inputs = document.querySelectorAll("input");

  inputs.forEach((input) => {
    input.addEventListener("focus", function () {
      let parentDiv = this.closest("div");
      let errorSpan;

      if (
        parentDiv &&
        parentDiv.nextElementSibling?.classList.contains("error")
      ) {
        errorSpan = parentDiv.nextElementSibling;
      } else if (this.nextElementSibling?.classList.contains("error")) {
        errorSpan = this.nextElementSibling;
      }

      if (errorSpan) {
        errorSpan.textContent = "";
      }
    });
  });
});
