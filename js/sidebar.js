
//SIDEBAR NAVIGATION

document.querySelectorAll('[data-action="filter-overview"]').forEach(elm => {

    elm.addEventListener("click", () => {

        document.querySelectorAll('.sidebar-li').forEach(li =>{
            li.style.color = "#37474F";
        })

        elm.style.color = "#63987C";
        filterOverviewPage();

        if (window.innerWidth < 700) {
            closeNav();
        }
    });
})

document.querySelectorAll('[data-action="filter-single-page"]').forEach(elm => {
    elm.addEventListener("click", filterSinglePage);
})

function filterOverviewPage() {

    const categoryTitle = event.target.textContent;
    const category = event.target.dataset.filter;
    getArticles(category, categoryTitle);
}

function filterSinglePage() {
    const category = event.target.dataset.filter;
    location.href = "articles-overview.php?category=" + category;
}

async function getArticles(category, categoryTitle) {

    const formData = new FormData();
    formData.set('category', category);
    const conn = await fetch('apis/api-category-article-list.php', {
        method: "POST",
        body: formData
    });
    const result = await conn.text();
    const articles = JSON.parse(result);

    displayArticles(articles, categoryTitle);

}

function displayArticles(articles, categoryTitle) {

    document.querySelector(".category-title").textContent = categoryTitle;

    const contentWrapper = document.querySelector("#articlesList");
    contentWrapper.innerHTML = '';
    const template = document.querySelector("template.article-template");

    if (articles.length == 0) {
        document.querySelector(".not-found").textContent = "No articles found";
    } else {

        document.querySelector(".not-found").textContent = "";
        articles.forEach(elm => {
            if (elm.is_visible == '1') {
                
                const clone = template.cloneNode(true).content;
                clone.querySelector(".article-name").textContent = elm.title;
                clone.querySelector(".article-description").textContent = elm.description.substring(0, 200) + '...';
                clone.querySelector(".article-a").setAttribute("href", `article.php?id=${elm.id}`);
    
                contentWrapper.appendChild(clone);
            }

        });
    }
}


//COLLAPSIBLE SIDEBAR

document.querySelectorAll("#openNav").forEach(elm =>{
    elm.addEventListener('click', openNav);
})
document.querySelector(".closebtn").addEventListener('click', closeNav);

function openNav() {
    document.querySelector("#mySidebar").style.width = "275px";
    document.querySelector("#main-sidebar").style.marginLeft = "275px";
}

function closeNav() {
    document.querySelector("#mySidebar").style.width = "0";
    document.querySelector("#main-sidebar").style.marginLeft = "0";
}