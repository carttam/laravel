<nav id="top_nav" class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <button class="navbar-toggler mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="d-flex">
                <input class="form-control me-2 ms-1" type="search" dir="rtl" placeholder="جستوجو کنید..." aria-label="Search">
                <button class="btn btn-outline-warning" type="submit"> <i class="bi bi-search"></i> </button>
            </form>

            <div class="d-inline-block me-3">
                <input type="checkbox" id="switch"/><label for="switch" class="switch-label">Toggle</label>
            </div>

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('home')}}">خانه</a>
                </li>
            </ul>
        </div>
        <a class="navbar-brand" href="#">پنل مدیریتی</a>
    </div>
</nav>
