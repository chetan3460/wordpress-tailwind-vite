<?php get_header(); ?>
<main class=" flex items-center justify-center flex-col ">
	<!-- Start Hero -->
	<section class="relative table w-full lg:py-40 md:py-36 pt-36 pb-24 overflow-hidden  bg-green-500">
		<div class="absolute inset-0 bg-[url('<?php echo get_template_directory_uri(); ?>/images/sass/overlay.webp')] bg-repeat opacity-10 dark:opacity-60">
		</div>
		<div class="container relative z-1">
			<div class="relative grid lg:grid-cols-12 grid-cols-1 items-center mt-10 gap-[30px]">
				<div class="lg:col-span-7">
					<div class="lg:me-6 lg:text-start text-center">
						<h1
							class="font-bold lg:leading-normal leading-normal text-4xl lg:text-6xl mb-5 text-white">
							Access
							powerful AI <br>For <span
								class="typewrite bg-gradient-to-tl to-indigo-600 from-red-600 text-transparent bg-clip-text"
								data-period="2000"
								data-type='[ "Ai Content", "Blog Writing", "Technical Writing" ]'> <span
									class="wrap"></span> </span></h1>
						<p class="text-lg max-w-xl lg:ms-0 mx-auto text-slate-600 dark:text-slate-300">Beatae cum
							eius, animi itaque aliquid ducimus
							facere dicta, vitae ipsam maiores nam sit blanditiis, quisquam expedita?</p>

						<div class="subcribe-form mt-6 mb-3">
							<form class="relative max-w-md mx-auto lg:ms-0">
								<div class="relative">
									<i
										class="uil uil-envelope text-xl absolute top-3 left-5 text-slate-600 dark:text-slate-300"></i>
									<input type="email" id="aiemail" name="email"
										class="py-4 pe-40 ps-12 w-full h-[50px] outline-none text-black dark:text-white rounded-md bg-white/60 dark:bg-slate-900/60 shadow dark:shadow-gray-800"
										placeholder="support@techwind.com">
								</div>
								<button type="submit"
									class="py-2 px-5 inline-block font-semibold tracking-wide align-middle duration-500 text-base text-center absolute top-[2px] end-[3px] h-[46px] bg-indigo-600 hover:bg-indigo-700 border border-indigo-600 hover:border-indigo-700 text-white rounded-md">Sign
									Up</button>
							</form><!--end form-->
						</div>
					</div>
				</div><!--end col-->

				<div class="lg:col-span-5">
					<div
						class="relative after:content-[''] after:absolute lg:after:-top-0 after:-top-10 after:-right-32 after:size-[36rem] after:border-2 after:border-dashed after:border-slate-300 dark:after:border-slate-700 after:rounded-full after:animate-[spin_120s_linear_infinite] after:-z-1 before:content-[''] before:absolute lg:before:-top-24 before:-top-36 before:-right-56 before:size-[48rem] before:border-2 before:border-dashed before:border-slate-200 dark:before:border-slate-700 before:rounded-full before:animate-[spin_240s_linear_infinite] before:-z-1">
						<div
							class="relative after:content-[''] after:absolute lg:after:-top-0 after:-top-10 after:-right-40 after:size-[36rem] after:bg-gradient-to-tl after:to-indigo-600/30  after:from-red-600/30 dark:after:to-indigo-600/50 dark:after:from-red-600/50 after: after:blur-[200px] after:rounded-full after:-z-1">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/saas/light-dash.png" class="lg:max-w-none lg:ms-14"
								alt="">
						</div>
					</div>
				</div><!--end col-->
			</div><!--end grid-->
		</div><!--end container-->
	</section>
	<!--end section-->
	<!-- End Hero -->
	<h1 class="text-4xl font-bold text-blue-600">Vite Base Theme Active</h1>
</main>


<?php get_footer(); ?>