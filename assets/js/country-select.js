// ===============================
// Country Selector
// ===============================

const selectedCountry = document.querySelector(".selected-country");
const countryDropdown = document.querySelector(".country-dropdown");
const countryList = document.querySelector(".country-list");
const countrySearch = document.querySelector(".country-search");


// ===============================
// Open / Close Dropdown
// ===============================

selectedCountry.addEventListener("click", () => {

    countryDropdown.classList.toggle("active");

    // selectedCountry.classList.toggle("active");
    
    // countryDropdown.classList.remove("active");
    
    // selectedCountry.classList.remove("active");
});


// ===============================
// Close When Click Outside
// ===============================

document.addEventListener("click", (e) => {

    if (!e.target.closest(".country-selector")) {

        countryDropdown.classList.remove("active");

    }

});


// ===============================
// Load Countries
// ===============================

function loadCountries() {

    countryList.innerHTML = "";

    countries.forEach(country => {

        const item = document.createElement("div");

        item.className = "country-item";

        item.innerHTML = `

            <img src="${country.flag}" alt="${country.name}">

            <span>${country.short}</span>

            <small>${country.code}</small>

        `;

        item.addEventListener("click", () => {

            document.querySelector(".selected-country img").src = country.flag;

            document.querySelector(".selected-country img").alt = country.name;

            document.querySelector(".selected-country span").textContent =
                `${country.short} ${country.code}`;

            countryDropdown.classList.remove("active");

        });

        countryList.appendChild(item);

    });

}

loadCountries();

// ===============================
// Search Country
// ===============================

countrySearch.addEventListener("keyup", () => {

    const value = countrySearch.value.toLowerCase();

    const items = document.querySelectorAll(".country-item");

    items.forEach(item => {

        const text = item.innerText.toLowerCase();

        if (text.includes(value)) {

            item.style.display = "flex";

        } else {

            item.style.display = "none";

        }

    });

});