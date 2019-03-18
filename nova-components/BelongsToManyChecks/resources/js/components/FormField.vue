<template>
    <default-field :field="field" :errors="errors" :fullWidthContent="true">
        <template slot="field">
            <div v-for="(group, key) in groupedValues">
                <h3 class="capitalize font-semibold pt-2">{{key}}</h3>
                <div class="flex flex-wrap w-full pt-3">
                    <span v-for="option in group" class="w-1/4 mb-2">
                        <checkbox
                            class="pb-2"
                            @input="toggle(option)"
                            :id="'belongs-to-check-'+option.value"
                            :name="field.name"
                            :checked="option.selected"
                        >
                            <span class="ml-1 cursor-default select-none" @click="toggle(option)">{{option.name}}</span>

                        </checkbox>
                    </span>
                </div>
            </div>
        </template>
    </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    data() {
        return {
            // 'options' : {
            //     'essentials' : []
            // },
            options : [],
            selectedOptions : []
        }
    },

    methods: {
        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
            this.initData();
            return false;
            // console.log(Object.assign({},this.field.populateWith));
            let col = _.chain(this.field.populateWith)
                .groupBy('type')
                .value();
                // .forEach(obj => {
                //     console.log(obj);
                //     Vue.set(this.options, 'essentials', obj);
                // });
            let self = this;
            Object.keys(col).forEach(function (item) {
                self.$set(self.options,item,col[item]);
                // console.log(item); // key
                // console.log(lunch[item]); // value
            });
                // .value();
            // console.log(col);
            console.log(Object.assign({},this.options));
            console.log(Object.assign({},this.options.outdoors[0]));
            // Vue.set(options)
            // let self = this;
            // self.options = col;
            
            // this.field.populateWith.forEach((option)=>{
            //     // console.log(Object.assign({},option));
            //     self.options.push({
            //         value : option.id,
            //         label : option.name,
            //         selected : self.field.selected.includes(option.id)
            //     })
            // });
            // console.log(self.options);
            console.log(typeof(this.options.essentials));
            console.log(this.options.essentials);
            console.log(this.flatten(this.options));
        },

        initData() {
            let self = this;
            // this.options = [];
            this.field.populateWith.forEach((option)=>{
                self.options.push({
                    value : option.id,
                    name : option.name,
                    type : option.type,
                    selected : self.field.selected.includes(option.id)
                })
            });
        },

        flatten(obj) {
            for (var i = 0; i < obj.length; i++) {
                for (var p in obj[i]) {
                    out[p] = obj[i][p];
                }
            }
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
            formData.append(this.field.attribute, this.selectedValues)
        },

        /**
         * Update the field's internal value.
         */
        handleChange(selectedValues) {
            this.options.forEach(option => {
                option.selected = (selectedValues.includes(option.id)) ? true : false;
            });
        },

        toggle(option) {
            // console.log(option);
            // option = this.options.find((option) => id == option.id);
            // this.options.find(item => item.id == option.id);
            option.selected = (!option.selected)
            // let group = this.options[option.type];
            // console.log(typeof(group));
            // let index = this.options.findIndex(item => item.id === option.id);
            // this.$set(this.options,index,option);
                
        }
    },

    computed: {
        selectedValues() {
            return this.options
                .filter(option => option.selected)
                .map(option => option.value);
        },
        groupedValues() {
            let col = _.chain(this.options)
                .groupBy('type')
                .value();
                
            return col;
            
            
            let self = this;
            Object.keys(col).forEach(function (item) {
                self.$set(self.options,item,col[item]);
                // console.log(item); // key
                // console.log(lunch[item]); // value
            });
        }
    }
}
</script>
