@extends('frontend.layout.app')

@section('content')


	<section id="billboard">

		<div class="container">
			<div class="row">
				<div class="col-md-12">

					<button class="prev slick-arrow">
						<i class="icon icon-arrow-left"></i>
					</button>

					<div class="main-slider pattern-overlay">
						<div class="slider-item">
							<div class="banner-content">
								<h2 class="banner-title">Laskar Pelangi</h2>
								<p>mengisahkan petualangan Raib, Seli, dan Ali ke Klan Matahari. Mereka menjelajahi dunia baru, mengikuti festival bunga matahari, dan berhadapan dengan rintangan berbahaya serta intrik politik, sambil menekankan nilai persahabatan, kerja sama, dan keberanian. </p>
								<div class="btn-wrap">
									<a href="#" class="btn btn-outline-accent btn-accent-arrow">Read More<i
											class="icon icon-ns-arrow-right"></i></a>
								</div>
							</div><!--banner-content-->
							<img src="{{ asset('assetsfrontend/images/main-banner1.jpg') }}" alt="banner" class="banner-image">
						</div><!--slider-item-->

						<div class="slider-item">
							<div class="banner-content">
								<h2 class="banner-title">Birds gonna be Happy</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu feugiat amet, libero
									ipsum enim pharetra hac. Urna commodo, lacus ut magna velit eleifend. Amet, quis
									urna, a eu.</p>
								<div class="btn-wrap">
									<a href="#" class="btn btn-outline-accent btn-accent-arrow">Read More<i
											class="icon icon-ns-arrow-right"></i></a>
								</div>
							</div><!--banner-content-->
							<img src="{{ asset('assetsfrontend/images/main-banner2.jpg') }}" alt="banner" class="banner-image">
						</div><!--slider-item-->

					</div><!--slider-->

					<button class="next slick-arrow">
						<i class="icon icon-arrow-right"></i>
					</button>

				</div>
			</div>
		</div>

	</section>

<section id="popular-books" class="bookshelf py-5 my-5">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<div class="section-header align-center">
					<h2 class="section-title">Perpustakaan Digital</h2>
				</div>

				<!-- SEARCH -->
				<div class="search-box text-center mb-4">
					<input type="text" id="searchInput" class="form-control w-50 mx-auto" placeholder="Cari buku...">
				</div>

				<ul class="tabs">
					<li data-tab-target="#all-genre" class="active tab">Semua Kategori</li>
					<li data-tab-target="#business" class="tab">Sejarah</li>
					<li data-tab-target="#technology" class="tab">Pendidikan</li>
					<li data-tab-target="#romantic" class="tab">Novel</li>
					<li data-tab-target="#adventure" class="tab">Seni & Budaya</li>
					<li data-tab-target="#fictional" class="tab">Agama</li>
				</ul>

				<div class="tab-content">
					<div id="all-genre" data-tab-content class="active">
                    <div class="row">
                    
                    @foreach($buku as $item)
                    
                    <div class="col-md-3 col-sm-6 book-item">
                    
                    <a href="#" style="text-decoration:none; color:black;">
                    
                    <div class="product-item"
                         data-title="{{ strtolower($item->judul) }}"
                         data-author="{{ strtolower($item->pengarang) }}">
                    
                    <figure class="product-style">
                    
                    @if($item->gambar) <img src="{{ asset('storage/'.$item->gambar) }}">
                    @else <img src="{{ asset('assetsfrontend/images/tab-item1.jpg') }}">
                    @endif
                    
                    </figure>
                    
                    <figcaption>
                    
                    <h6>{{ $item->judul }}</h6>
                    
                    <span>{{ $item->pengarang }}</span>
                    
                    <p class="stock">
                    Stock {{ $item->stok }}
                    </p>
                    
                    </figcaption>
                    
                    </div>
                    
                    </a>
                    
                    </div>
                    
                    @endforeach
                    
                    </div>

					</div>

					<!-- TAB LAIN -->
					<div id="business" data-tab-content>
						<div class="row">
							<div class="col-md-3 col-sm-6 book-item">
								<div class="product-item" data-title="History Book" data-author="John Doe">
									<figure class="product-style">
										<img src="{{ asset('assetsfrontend/images/tab-item2.jpg') }}">
									</figure>
									<figcaption>
										<h6>History Book</h6>
										<span>John Doe</span>
										<p class="stock">Stock 3</p>
									</figcaption>
								</div>
							</div>
						</div>
					</div>

				</div>

			</div>
		</div>
	</div>
</section>

<!-- CSS -->
<style>

/* SEARCH (tetap) */
.search-box input {
	border-radius: 30px;
	padding: 10px 20px;
	border: 1px solid #ccc;
	box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

/* === FIX TAMPILAN BUKU === */

/* card */
.product-item {
	text-align: center;
	padding: 15px;
}

/* gambar */
.product-style img {
    width: 100%;
    height: auto;       /* BIAR NGIKUTIN RASIO ASLI */
    display: block;
    margin-bottom: 10px;
}

/* text */
figcaption {
	text-align: center;
}

/* judul */
figcaption h6 {
	margin: 8px 0 2px;
}

/* penulis */
figcaption span {
	display: block;
	color: #777;
}

/* stock */
.stock {
	color: #999;
	font-size: 13px;
	margin-top: 3px;
}

/* jarak antar item */
.book-item {
	margin-bottom: 30px;
}

</style>

<!-- SCRIPT SEARCH -->
<script>
document.getElementById('searchInput').addEventListener('keyup', function() {
	let keyword = this.value.toLowerCase();
	let items = document.querySelectorAll('.book-item');

	items.forEach(item => {
		let title = item.querySelector('.product-item').dataset.title.toLowerCase();
		let author = item.querySelector('.product-item').dataset.author.toLowerCase();

		item.style.display = (title.includes(keyword) || author.includes(keyword)) ? 'block' : 'none';
	});
});
</script>

@endsection