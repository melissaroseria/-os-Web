document.addEventListener("DOMContentLoaded", function () {
    const searchButton = document.getElementById("searchButton");
    const searchEngine = document.getElementById("searchEngine");
    const searchInput = document.getElementById("searchInput");

    searchButton.addEventListener("click", function () {
        const selectedEngine = searchEngine.value;
        const query = searchInput.value;

        if (query) {
            let url = "";
            switch (selectedEngine) {
                case "google":
                    url = `https://www.google.com/search?q=${encodeURIComponent(query)}`;
                    break;
                case "bing":
                    url = `https://www.bing.com/search?q=${encodeURIComponent(query)}`;
                    break;
                case "duckduckgo":
                    url = `https://duckduckgo.com/?q=${encodeURIComponent(query)}`;
                    break;
            }
            window.open(url, "_blank");
        } else {
            alert("Please enter a search query!");
        }
    });
});