<template>
    <panel-item :field="field" :fullWidthContent="true">
        <template slot="value">
            <div class="flex flex-wrap" v-if="field.selected.length">
                <span v-for="option in field.populateWith"
                    class="w-1/4 mb-1"
                    v-if="field.selected.includes(option.id)"
                >
                    <span class="inline-block mr-1 text-success">
                        <svg
                            class="block fill-current h-4 w-4"
                            version="1.1"
                            xmlns="http://www.w3.org/2000/svg"
                            width="28"
                            height="28"
                            viewBox="0 0 28 28"
                        >
                            <title>check</title>
                            <path d="M26.109 8.844c0 0.391-0.156 0.781-0.438 1.062l-13.438 13.438c-0.281 0.281-0.672 0.438-1.062 0.438s-0.781-0.156-1.062-0.438l-7.781-7.781c-0.281-0.281-0.438-0.672-0.438-1.062s0.156-0.781 0.438-1.062l2.125-2.125c0.281-0.281 0.672-0.438 1.062-0.438s0.781 0.156 1.062 0.438l4.594 4.609 10.25-10.266c0.281-0.281 0.672-0.438 1.062-0.438s0.781 0.156 1.062 0.438l2.125 2.125c0.281 0.281 0.438 0.672 0.438 1.062z"></path>
                        </svg>
                    </span>
                    {{option.name}}
                </span>
            </div>
            <div v-else>
                -
            </div>
        </template>
    </panel-item>
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],
    data() {
        return {
            'options' : [
                {
                    'label' : ''
                }
            ]
        }
    },
    computed: {
        // groupedFields() {
        //     if (this.field.hasOwnProperty('populateWith') && this.field.populateWith) {
        //         this.field.populateWith
        //     }
        // }
    }

}
</script>
