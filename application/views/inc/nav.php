<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?=base_url();?>">
      Stok Kontrolü
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?=base_url();?>"><?=$this->lang->line('home');?></a>
        </li>
      </ul>
      <form class="d-flex" role="search">
          <div class="input-group me-2">
            <input type="text" class="form-control" type="search"  placeholder="<?=$this->lang->line('search');?>" aria-label="<?=$this->lang->line('search');?>" aria-describedby="search-addon">
            <span class="input-group-text fas fa-search" id="search-addon"></span>
          </div>
      </form>
    </div>
  </div>
</nav>