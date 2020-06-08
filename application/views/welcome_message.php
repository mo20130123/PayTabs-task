
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
 	<head>
 		<meta charset="utf-8">
 		<title>cats</title>
		<link rel="stylesheet" href="<?= base_url('assets/app.css'); ?>">
		<link rel="stylesheet" href="<?= base_url('assets/bootstrap.min.css'); ?>">
		<style media="screen">
			select {
				margin-bottom: 10px;
			}
		</style>
 	</head>
 	<body>

		<section id="myVue">

			<div class="container">
				<h2>Task Mohamed Zayed</h2>
				<p> <b>you can add unlimited sub categories from the database</b>  </p>
				<p> added test Example:- super 1  >> super - cat 1  >> super - cat 1 - cat 1  >> super - cat 1 - cat 1 - cat 1</p>
				<hr>

				<select v-for="Category in Categories"   @change="get_Category_subs($event)"  class="form-control"   >
					<option value=""></option>
					<option v-for="cat in Category.cats" :value="cat.id">{{cat.name}}</option>
				</select>

				<hr>
				<ul v-for="Category in Categories">
					<!-- <li> {{Category}} </li> -->
					<ul v-for="cat in Category.cats">
						<li> {{cat.name}} </li>
					</ul>
				</ul>
			</div>

		</section><!--End id="myVue"-->


		<script src="<?= base_url('assets/app.js'); ?>"> </script>
		<script src="<?= base_url('assets/jQuery.js'); ?>"> </script>
		<script>
			const base_url = '<?= base_url() ?>';
			let myVue = new Vue({
				el: '#myVue',
				data: {
					Categories: [],
				},
				created()
				{
					 this.get_main_list();
				},
				methods:{
					get_main_list()
					{
							$.get(`${base_url}CategoryController/get_super_Categories`,function(Result){
									this.Categories = JSON.parse(Result);
							}.bind(this));
					},
					get_Category_subs(event)
					{
				        var chosen = event.target.value;
							$.get(`${base_url}CategoryController/get_Category_subs/${chosen}`,function(Result){
									this.Categories = JSON.parse(Result);
							}.bind(this));
					}
				}//End methods
			});//End myVue
		</script>
 	</body>
 </html>
