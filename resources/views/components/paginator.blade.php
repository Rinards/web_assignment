<?php $cap = 100; ?>
<div class="w-100 d-flex flex-row justify-content-around mt-5">
    <ul class="pagination ">
    <li class="page-item">
      <a class="page-link text-dark" href="/{{$type}}/<?= ($page < 1) ? $page = 1 : $page - 1 ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link text-dark" href="/{{$type}}/{{$page}}">{{$page}}</a></li>
    <li class="page-item">
      <a class="page-link text-dark" href="/{{$type}}/<?= ($page > $cap) ? $page = $cap : $page + 1 ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</div>