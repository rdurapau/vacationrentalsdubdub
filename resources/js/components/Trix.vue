// Copied from Laravel Nova's Trix component

<template>
    <trix-editor
        ref="theEditor"
        @keydown.stop
        @trix-change="handleChange"
        @trix-initialize="initialize"
        @trix-attachment-add="handleAddFile"
        @trix-attachment-remove="handleRemoveFile"
        @trix-file-accept="handleFileAccept"
        :value="value"
        :placeholder="placeholder"
        class="trix-content"
    />
</template>

<script>
import Trix from 'trix'
import 'trix/dist/trix.css'

Vue.config.ignoredElements = ['trix-editor']

export default {
    name: 'trix-vue',

    props: {
        name: { type: String },
        value: { type: String },
        placeholder: { type: String },
        withFiles: { type: Boolean, default: true },
    },

    methods: {
        initialize() {
            this.$refs.theEditor.editor.insertHTML(this.value)
        },

        handleChange() {
            this.$emit('change', this.$refs.theEditor.value)
        },

        handleFileAccept(e) {
            if (!this.withFiles) {
                e.preventDefault()
            }
        },

        handleAddFile(event) {
            this.$emit('file-add', event)
        },

        handleRemoveFile(event) {
            this.$emit('file-remove', event)
        },
    },
}
</script>

<style lang="scss">

    trix-editor, .trix-content {
        * {
            line-height:1.5 !important;
        }
        h1 {
            font-size:1.2em !important;
            letter-spacing:0 !important;
            border-bottom:none !important;
            padding:0 !important;
        }
        em {
            font-style:italic;
        }
        del {
            text-decoration: line-through;
        }
        strong {
            font-weight:inherit;
            font-weight:bolder;
        }
        ul {
            list-style:disc outside;
        }
        ol {
            list-style: decimal outside;
        }
    }

</style>
