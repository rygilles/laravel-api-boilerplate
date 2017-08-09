<template>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<h4>Select 2 with init options</h4>
				<Select2
					:options="select2case1options"
					labelProp="lab"
					valueProp="id"
					v-model="select2case1value"
				></Select2>
				<div style="margin-top: 10px">
					<p>
						Current outside component value = <span v-html="select2case1value"></span>
					</p>
					<button class="btn btn-default" @click="select2case1value = 'Id3'">Set to "Id3"</button>
					<button class="btn btn-default" @click="select2case1addOption" v-html="'Add Id' + (this.select2case1options.length + 1)"></button>
					<button class="btn btn-danger" @click="select2case1removeSelectedOption" v-html="'Remove ' + this.select2case1removeInput"></button>
					: <input type="text" v-model="select2case1removeInput" />
				</div>
				<br />
				<h4>Select 2 with Ajax feed (valueProp = labelProp)</h4>
				<Select2
					:feed="{
						getUri : '/userGroup',
						params : {
							limit: 10,
							order_by: 'id,asc',
						}
					}"
					labelProp="id"
					valueProp="id"
					v-model="select2case2value"
				></Select2>
				<div style="margin-top: 10px">
					<p>
						Current outside component value = <span v-html="select2case2value"></span>
					</p>
					<button class="btn btn-default" @click="select2case2value = select2case2SetToInput">Set to</button>
					: <input type="text" v-model="select2case2SetToInput" />
				</div>
				<br />
				<h4>Select 2 with Ajax feed (valueProp != labelProp)</h4>
				<Select2
					:feed="{
						getUri : '/user',
						params : {
							limit: 10,
							order_by: 'id,asc',
						}
					}"
					labelProp="name"
					valueProp="id"
					v-model="select2case3value"
				></Select2>
				<div style="margin-top: 10px">
					<p>
						Current outside component value = <span v-html="select2case3value"></span>
					</p>
					<button class="btn btn-default" @click="select2case3value = select2case3SetToInput">Set to</button>
					: <input type="text" v-model="select2case3SetToInput" />
				</div>
				<h4>Select 2 with Ajax feed (valueProp != labelProp) and multiple values</h4>
				<Select2
					:feed="{
						getUri : '/user',
						params : {
							limit: 10,
							order_by: 'id,asc',
						}
					}"
					labelProp="name"
					valueProp="id"
					v-model="select2case4value"
					:multiple="true"
				></Select2>
				<div style="margin-top: 10px">
					<p>
						Current outside component value = <span v-html="select2case4value"></span>
					</p>
				</div>
				<h4>Select 2 with Ajax feed (valueProp = labelProp) and multiple values</h4>
				<Select2
					:feed="{
						getUri : '/i18nLang',
						params : {
							limit: 10,
							order_by: 'id,asc',
						}
					}"
					labelProp="id"
					valueProp="id"
					v-model="select2case5value"
					:multiple="true"
				></Select2>
				<div style="margin-top: 10px">
					<p>
						Current outside component value = <span v-html="select2case5value"></span>
					</p>
				</div>
				<h4>Select 2 with init options (valueProp != labelProp) and multiple values</h4>
				<Select2
					:options="select2case6options"
					labelProp="lab"
					valueProp="id"
					v-model="select2case6value"
					:multiple="true"
				></Select2>
				<div style="margin-top: 10px">
					<p>
						Current outside component value = <span v-html="select2case6value"></span>
					</p>
				</div>
				<h4>Select 2 with init options (valueProp = labelProp) and multiple values</h4>
				<Select2
					:options="select2case7options"
					labelProp="id"
					valueProp="id"
					v-model="select2case7value"
					:multiple="true"
				></Select2>
				<div style="margin-top: 10px">
					<p>
						Current outside component value = <span v-html="select2case7value"></span>
					</p>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
	import Select2 from '../includes/select2'

	export default {
		name: 'Tests',

		components: {Select2},

		data() {
			return {
				select2case1value: 'Id2',
				select2case1options: [
					{
						id: 'Id1',
						lab : 'Label1',
					},
					{
						id: 'Id2',
						lab : 'Label2',
					},
					{
						id : 'Id3',
						lab : 'Label3',
					},
				],
				select2case1removeInput: 'Id1',

				select2case2value: 'Developer',
				select2case2SetToInput: 'End-User',

				select2case3value: '509dd5c0-1389-11e7-93ae-92361f002671',
				select2case3SetToInput: '605c7610-1389-11e7-93ae-92361f002671',

				select2case4value: ['605c7610-1389-11e7-93ae-92361f002671', '509dd5c0-1389-11e7-93ae-92361f002671'],

				select2case5value: ['en', 'fr'],

				select2case6options: [
					{
						id: 'Id1',
						lab : 'Label1',
					},
					{
						id: 'Id2',
						lab : 'Label2',
					},
					{
						id : 'Id3',
						lab : 'Label3',
					},
				],
				select2case6value: ['Id1', 'Id2'],

				select2case7options: [
					{
						id: 'Id1',
						lab : 'Id1',
					},
					{
						id: 'Id2',
						lab : 'Id2',
					},
					{
						id : 'Id3',
						lab : 'Id3',
					},
				],
				select2case7value: ['Id1', 'Id2'],
			};
		},

		methods: {
			select2case1addOption() {
				this.select2case1options.push({
					id: 'Id' + (this.select2case1options.length + 1),
					lab: 'Label' + (this.select2case1options.length + 1),
				});
			},
			select2case1removeSelectedOption() {
				this.select2case1options.forEach((option, index) => {
					if (option.id == this.select2case1removeInput) {
						this.select2case1options.splice(index, 1);
						return;
					}
				});
			},
		}
	}
</script>