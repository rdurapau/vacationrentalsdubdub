<template>
    <section class="container-body">
        <form
            action="/register"
            method="post"
        >

            <input
                type="hidden"
                name="_token"
                v-model="csrf"
            >

            <div class="column form-stuffs">
                <div class="row form-and-null">
                    <div class="column col-md-12 actual-form">
                        <div class="sweetspot-form">
                            <fieldset class="section-wrap">
                                <section>
                                    <h1>Sign Up</h1>

                                    <section
                                        class="fieldset single-field"
                                        :class="{'has-error': errors.has('scope-1.name')}"
                                    >
                                        <input
                                            type="text"
                                            id="name"
                                            name="name"
                                            v-model="name"
                                            :disabled="isSubmitting"
                                            :class="{'filled': (name.length || name > 0), 'ouch': errors.has('scope-1.name')}"
                                            v-validate="'required'"
                                            data-vv-as="Name"
                                            data-vv-scope="scope-1"
                                        />
                                        <label for="name">Name</label>
                                        <span
                                            class="errors"
                                            v-if="errors.has('scope-1.name')"
                                        >{{ errors.first('scope-1.name') }}</span>
                                    </section>

                                    <section
                                        class="fieldset single-field"
                                        :class="{'has-error': errors.has('scope-1.email')}"
                                    >
                                        <input
                                            type="text"
                                            id="email-address"
                                            name="email"
                                            v-model="email"
                                            :disabled="isSubmitting"
                                            :class="{'filled': (email.length || email > 0), 'ouch': errors.has('scope-1.email')}"
                                            v-validate="'required|email'"
                                            data-vv-as="Email"
                                            data-vv-scope="scope-1"
                                        />
                                        <label for="email-address">Email Address</label>
                                        <span
                                            class="errors"
                                            v-if="errors.has('scope-1.email')"
                                        >{{ errors.first('scope-1.email') }}</span>
                                    </section>

                                    <section class="fieldset">
                                        <section
                                            class="fieldset single-field"
                                            :class="{'has-error': errors.has('scope-1.password')}"
                                        >
                                            <input
                                                type="password"
                                                name="password"
                                                id="password"
                                                v-model="password"
                                                :disabled="isSubmitting"
                                                :class="{'filled': (password.length || password > 0), 'ouch': errors.has('scope-1.password')}"
                                                v-validate="'required'"
                                                data-vv-as="Password"
                                                data-vv-scope="scope-1"
                                            />
                                            <label for="password">Password</label>
                                            <span
                                                class="errors"
                                                v-if="errors.has('scope-1.password')"
                                            >{{ errors.first('scope-1.password') }}</span>
                                        </section>

                                    </section>
                                </section>
                            </fieldset>
                        </div>
                    </div>
                </div>

                <div class="row action-row">
                    <button
                        class="btn btn-block"
                        type="submit"
                    >Sign In</button>
                </div>
            </div>

        </form>
    </section>
</template>

<script>
import { mapActions, mapGetters } from "vuex";

export default {
    data() {
        return {
            name: "",
            email: "",
            password: "",
            isSubmitting: false
        };
    },

    mounted() {},

    computed: {
        csrf() {
            return window.Laravel.csrfToken;
        }
    },

    methods: {}
};
</script>

