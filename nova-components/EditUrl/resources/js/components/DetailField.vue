<template>
    <panel-item :field="field">
        <template slot="value">
            <div class="flex align-center justify-start">
                <a class="text-primary-dark" target="_blank" :href="field.value">{{field.value}}</a>
                </div><div>
                <button class="bg-primary hover:bg-primary-dark text-white font-bold text-sm py-1 px-2 mt-2 rounded flex align-center justify-start">
                    <svg class="icon-location w-4 h-auto mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="#fff" class="heroicon-ui" d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2zm16 3.38V6H4v1.38l8 4 8-4zm0 2.24l-7.55 3.77a1 1 0 0 1-.9 0L4 9.62V18h16V9.62z"/>
                    </svg>
                    Resend to Owner
                </button>
            </div>
        </template>
    </panel-item>
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],
}
</script>
