<template>
    <section class="container-body">

        <div class="column form-stuffs">
            <div class="row form-and-null">
                <div class="column col-md-12 actual-form">
                    <div class="sweetspot-form">
                        <fieldset class="section-wrap">
                            <section>
                                <h1>List Your Spot</h1>

                                <div
                                    class="alert alert-danger"
                                    v-if="errs !== false"
                                >
                                    <p
                                        v-for="(err, i) in Object.keys(errs)"
                                        :key="i"
                                    >
                                        {{errs[err][0]}}
                                    </p>
                                </div>

                                <section
                                    class="
                                        fieldset
                                        single-field"
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
                                        data-vv-as="First and Last Name"
                                        data-vv-scope="scope-1"
                                        style="width:100%"
                                    />
                                    <label for="name">Full Name</label>
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
                                        style="width:100%"
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
                                            style="width:100%"
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
                    @click="onClickSubmit"
                >Next</button>
            </div>
        </div>
    </section>
</template>

<script>
import { mapActions, mapGetters } from "vuex";

export default {
    data() {
        return {
            errs: false,

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

    methods: {
        ...mapActions(["signUp"]),

        onClickSubmit() {
            this.errs = false;

            this.signUp({
                name: this.name,
                email: this.email,
                password: this.password
            })
                .then(data => {
                    this.$store.commit("isAuth", true);
                    this.$store.commit("setUser", data.user);
                    localStorage.setItem("token", data.token);
                    this.$router.push("/spot-new");
                    this.$emit("close");
                })
                .catch(err =>
                    this.$root.errorHandler(err, err => {
                        console.log(err.data.errors);
                        this.errs = err.data.errors;
                    })
                );
        }
    }
};
</script>

