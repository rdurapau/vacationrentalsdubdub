<template>
    <section class="container-body">

        <div class="column progress-list-column">

            <ul class="progress-list">
                <li class="personal" :class="{'current' : visibleSection == 1, 'complete' : visibleSection > 1}" @click.prevent="'return false; goToSection(1)'">
                    <span>
                        <svg>
                            <g>
                                <g>
                                    <path
                                        d="M0,2.25 C0,1.00736 1.00736,0 2.25,0 L18.75,0 C19.9926,0 21,1.00736 21,2.25 L21,21.75 C21,22.9926 19.9926,24 18.75,24 L2.25,24 C1.00736,24 0,22.9926 0,21.75 L0,2.25 Z M2.25,1.5 C1.83579,1.5 1.5,1.83579 1.5,2.25 L1.5,21.75 C1.5,22.1642 1.83579,22.5 2.25,22.5 L18.75,22.5 C19.1642,22.5 19.5,22.1642 19.5,21.75 L19.5,2.25 C19.5,1.83579 19.1642,1.5 18.75,1.5 L2.25,1.5 Z M5.64,9.083 C5.64,6.3989 7.8159,4.223 10.5,4.223 C13.1841,4.223 15.36,6.3989 15.36,9.083 C15.36,11.7671 13.1841,13.943 10.5,13.943 C7.8159,13.943 5.64,11.7671 5.64,9.083 Z M10.5,5.723 C8.64432,5.723 7.14,7.22732 7.14,9.083 C7.14,10.9387 8.64432,12.443 10.5,12.443 C12.3557,12.443 13.86,10.9387 13.86,9.083 C13.86,7.22732 12.3557,5.723 10.5,5.723 Z M10.5,14.2043 C7.39031,14.2043 4.53632,15.9263 3.0865,18.6773 C2.89338,19.0438 3.03389,19.4974 3.40033,19.6905 C3.76677,19.8836 4.22038,19.7431 4.4135,19.3767 C5.6038,17.1181 7.94694,15.7043 10.5,15.7043 C13.0531,15.7043 15.3962,17.1181 16.5865,19.3767 C16.7796,19.7431 17.2332,19.8836 17.5997,19.6905 C17.9661,19.4974 18.1066,19.0438 17.9135,18.6773 C16.4637,15.9263 13.6097,14.2043 10.5,14.2043 Z"
                                        id="Shape"></path>
                                </g>
                            </g>
                        </svg>
                    </span>
                    Personal Info</li>
                <li class="location"  :class="{'current' : visibleSection == 2, 'complete' : visibleSection > 2}" @click.prevent="'return false; goToSection(2)'">
                    <span>
                        <svg>
                            <g>
                                <path d="M12.75,24c-1.241,0-2.25-1.009-2.25-2.25v-3.518c0-0.414,0.336-0.75,0.75-0.75S12,17.818,12,18.232v3.518
                        c0,0.414,0.336,0.75,0.75,0.75h6c0.414,0,0.75-0.336,0.75-0.75v-3.518c0-0.414,0.336-0.75,0.75-0.75S21,17.818,21,18.232v3.518
                        c0,1.241-1.009,2.25-2.25,2.25H12.75z" />
                                <path
                                    d="M23.25,18.232c-0.186,0-0.364-0.068-0.501-0.193l-6.5-5.847C16.11,12.068,15.932,12,15.747,12
                        c-0.185,0-0.363,0.069-0.502,0.193l-6.5,5.847c-0.138,0.124-0.316,0.192-0.501,0.192c-0.212,0-0.415-0.091-0.558-0.248
                        c-0.134-0.149-0.202-0.341-0.192-0.542c0.011-0.2,0.099-0.384,0.248-0.518l6.5-5.847c0.415-0.373,0.949-0.578,1.505-0.578
                        c0.555,0,1.09,0.205,1.504,0.578L21,14.449V12c0-0.414,0.336-0.75,0.75-0.75S22.5,11.586,22.5,12v3.799l1.251,1.126
                        c0.149,0.134,0.237,0.318,0.248,0.518c0.01,0.2-0.057,0.392-0.191,0.541C23.666,18.141,23.463,18.232,23.25,18.232z" />
                                <path d="M8.25,12.75c-2.481,0-4.5-2.019-4.5-4.5s2.019-4.5,4.5-4.5s4.5,2.019,4.5,4.5S10.731,12.75,8.25,12.75z M8.25,5.25
                        c-1.654,0-3,1.346-3,3s1.346,3,3,3s3-1.346,3-3S9.904,5.25,8.25,5.25z" />
                                <path d="M8.25,24C7.745,24,7.278,23.749,7,23.328c-0.701-1.056-2.448-3.863-4.038-6.922C0.996,12.626,0,9.882,0,8.25
                        C0,3.701,3.701,0,8.25,0s8.25,3.701,8.25,8.25C16.5,8.664,16.164,9,15.75,9C15.337,9,15,8.664,15,8.25
                        c0-3.722-3.028-6.75-6.75-6.75S1.5,4.528,1.5,8.25c0,2.881,4.396,10.702,6.75,14.25C8.664,22.5,9,22.836,9,23.25S8.664,24,8.25,24z
                        " />
                            </g>
                        </svg>
                    </span>
                    Property Location</li>
                <li class="details" :class="{'current' : visibleSection == 3, 'complete' : visibleSection > 3}" @click.prevent="'return false; goToSection(3)'">
                    <span>
                        <svg>
                            <g>
                                <path d="M10.498,15.75c-0.827,0-1.5-0.673-1.5-1.5v-3.399l-0.27,0.225c-0.135,0.112-0.305,0.174-0.48,0.174
                    c-0.223,0-0.433-0.098-0.576-0.27c-0.265-0.318-0.222-0.792,0.096-1.056l4.5-3.75C12.402,6.062,12.573,6,12.748,6
                    s0.346,0.062,0.48,0.174l4.5,3.75c0.154,0.128,0.249,0.309,0.267,0.508c0.018,0.199-0.042,0.394-0.171,0.548
                    c-0.143,0.172-0.353,0.27-0.576,0.27c-0.175,0-0.345-0.062-0.48-0.174l-0.27-0.225v3.399c0,0.827-0.673,1.5-1.5,1.5H10.498z
                    M10.498,14.25h4.5V9.601l-2.25-1.875l-2.25,1.875V14.25z" />
                                <path d="M0.749,24c-0.201,0-0.389-0.078-0.531-0.22c-0.224-0.224-0.283-0.566-0.147-0.852l2.911-6.113
                    c-0.974-1.702-1.486-3.632-1.484-5.596C1.507,5.033,6.547,0,12.733,0l0.036,0.375V0c2.102,0,4.157,0.587,5.941,1.697
                    c2.548,1.585,4.327,4.071,5.01,7.001s0.186,5.946-1.399,8.494c-1.587,2.552-4.073,4.333-6.999,5.015
                    c-0.848,0.198-1.714,0.298-2.574,0.298c0,0,0,0,0,0c-1.944,0-3.864-0.514-5.565-1.489l-6.113,2.912C0.97,23.975,0.859,24,0.749,24z
                    M12.743,1.5C7.37,1.503,3.006,5.862,2.998,11.221c-0.003,1.825,0.506,3.609,1.47,5.158c0.136,0.219,0.151,0.487,0.04,0.719
                    l-2.174,4.567l4.567-2.175C7,19.441,7.112,19.416,7.223,19.416c0.14,0,0.278,0.039,0.397,0.114c1.55,0.964,3.325,1.474,5.131,1.474
                    c0.746,0,1.497-0.087,2.232-0.258c2.536-0.591,4.69-2.135,6.066-4.346c2.839-4.565,1.435-10.589-3.13-13.429
                    C16.372,2.009,14.592,1.5,12.77,1.5c-0.004,0-0.031,0-0.033,0L12.743,1.5z" />
                            </g>
                        </svg>
                    </span>
                    Property Details</li>
                <li class="photos" :class="{'current' : visibleSection == 4, 'complete' : visibleSection > 4}" @click.prevent="'return false; goToSection(4)'">
                    <span>
                        <svg>
                            <g>
                                <path d="M1.501,18c-0.827,0-1.5-0.673-1.5-1.5v-15c0-0.827,0.673-1.5,1.5-1.5h13.5c0.827,0,1.5,0.673,1.5,1.5v15
                    c0,0.827-0.673,1.5-1.5,1.5H1.501z M1.501,16.5h13.5v-3h-13.5V16.5z M15.001,12v-0.468l-3.804-4.348
                    c-0.041-0.047-0.086-0.087-0.136-0.122c-0.127-0.089-0.274-0.135-0.427-0.135c-0.044,0-0.089,0.004-0.133,0.012
                    c-0.198,0.035-0.37,0.145-0.484,0.309L6.691,12H15.001z M4.861,12l3.926-5.612c0.343-0.492,0.859-0.822,1.451-0.927
                    c0.131-0.023,0.265-0.035,0.398-0.035c0.46,0,0.904,0.14,1.284,0.406c0.15,0.105,0.287,0.228,0.407,0.365l2.675,3.057V1.5h-13.5
                    l0,10.5H4.861z" />
                                <path d="M17.757,24c-0.161,0-0.321-0.026-0.474-0.077L6.519,20.334c-0.197-0.065-0.303-0.278-0.237-0.474l0.237-0.711
                    c0.031-0.094,0.099-0.172,0.188-0.217c0.053-0.026,0.11-0.04,0.168-0.04c0.04,0,0.08,0.006,0.119,0.019L17.757,22.5l4.743-14.23
                    l-3.982-1.328c-0.392-0.131-0.605-0.556-0.474-0.948c0.102-0.307,0.387-0.513,0.71-0.513c0.081,0,0.161,0.013,0.239,0.039
                    l3.982,1.327c0.38,0.127,0.688,0.394,0.867,0.752c0.179,0.359,0.208,0.766,0.081,1.146l-4.743,14.23
                    C18.976,23.587,18.404,24,17.757,24z" />
                                <path
                                    d="M5.064,7.501c-1.344,0-2.438-1.094-2.438-2.438S3.72,2.625,5.064,2.625s2.438,1.094,2.438,2.438S6.409,7.501,5.064,7.501z
                    M5.064,4.125c-0.517,0-0.938,0.421-0.938,0.938s0.421,0.938,0.938,0.938S6.002,5.58,6.002,5.063S5.581,4.125,5.064,4.125z" />
                            </g>
                        </svg>
                    </span>
                    Property Photos</li>
            </ul>

        </div>

        <div class="column form-stuffs">
            
            <!-- <form method="POST" action="/spots" @submit="submitForm" id="submit-property-form"> -->

                <div class="row form-and-null">

                    <div class="column actual-form">

                        <form class="sweetspot-form" method="POST" action="/spots" @submit="submitForm" id="submit-property-form" :disabled="isSubmitting">

                            <!-- Personal Info Section -->
                            <fieldset class="section-wrap" v-show="visibleSection == 1">

                                <section class="sub-section-row">
                                    <div class="sub-column">

                                    </div>
                                    <div class="sub-column">
                                        <h1>Personal Info</h1>
                                    </div>
                                </section>

                                <!-- Adding this nested wrap to allow me to split out floating comments -->
                                <section class="sub-section-row">

                                    <div class="section-description sub-column">
                                        <section class="description-detail">
                                            <h2>Nice to meet you!</h2>
                                            <p>The only information that will be shared with guests is your name and phone number so they can contact you directly.</p>
`                                            <p>Your email will be used for communication with us and for booking requests.</p>
                                        </section>
                                    </div>

                                    <div class="sub-column">

                                        <section class="fieldset required single-field add-on"
                                            :class="{'has-error': errors.has('scope-1.owner_name')}">
                                            <input type="text" id="full-name" name="owner_name"
                                                   v-model="owner_name" :disabled="isSubmitting"
                                                   :class="{'filled': (owner_name.length || owner_name > 0), 'ouch': errors.has('owner_name')}"
                                                   :maxlength="40"
                                                   data-vv-scope="scope-1"
                                                   v-validate="'required|max:40'" data-vv-as="Full Name"/>
                                            <label for="full-name">Your Full Name</label>
                                            <span class="errors"
                                                v-if="errors.has('scope-1.owner_name')">{{ errors.first('scope-1.owner_name') }}</span>
                                            <div class="add-on pill" v-text="40 - owner_name.length"></div>
                                        </section>

                                        <section class="fieldset">

                                            <section class="fieldset single-field"
                                                :class="{'has-error': errors.has('scope-1.email')}">
                                                <input type="text" id="email-address" name="email" v-model="email" :disabled="isSubmitting"
                                                    :class="{'filled': (email.length || email > 0), 'ouch': errors.has('scope-1.email')}"
                                                    v-validate="'required|email'" data-vv-as="Email" data-vv-scope="scope-1" />
                                                <label for="email-address">Email Address</label>
                                                <span class="errors"
                                                    v-if="errors.has('scope-1.email')">{{ errors.first('scope-1.email') }}</span>
                                            </section>

                                            <section class="fieldset single-field"
                                                :class="{'has-error': errors.has('scope-1.email_confirmation')}">
                                                <input type="text" id="confirm-email" name="email_confirmation" :disabled="isSubmitting"
                                                    v-model="email_confirmation"
                                                    :class="{'filled': (email_confirmation.length || email_confirmation > 0), 'ouch': errors.has('scope-1.email_confirmation')}"
                                                    data-vv-scope="scope-1"
                                                    v-validate="{ is: email, required: true }"
                                                    data-vv-as="Email Confirmation" />
                                                <label for="confirm-email">Confirm Email</label>
                                                <span class="errors"
                                                    v-if="errors.has('scope-1.email_confirmation')">{{ errors.first('scope-1.email_confirmation') }}</span>
                                            </section>

                                        </section>

                                        <section class="fieldset">

                                            <section class="fieldset single-field half-width"
                                                :class="{'has-error': errors.has('scope-1.phone')}">
                                                <input type="phone" name="phone" id="phone-number" v-model="phone" :disabled="isSubmitting"
                                                    :class="{'filled': (phone.length || phone > 0), 'ouch': errors.has('scope-1.phone')}"
                                                    v-validate="'required'" data-vv-as="Phone" data-vv-scope="scope-1" />
                                                <label for="phone-number">Phone Number</label>
                                                                                                <span class="errors"
                                                    v-if="errors.has('scope-1.phone')">{{ errors.first('scope-1.phone') }}</span>
                                            </section>

                                        </section>

                                    </div><!-- End sub column -->

                                </section><!-- END sub-section-row -->

                            </fieldset>

                            <!-- Property Location Section -->
                            <fieldset class="section-wrap" v-show="visibleSection == 2">

                                <section class="sub-section-row">
                                    <div class="sub-column">

                                    </div>
                                    <div class="sub-column">
                                        <h1>Property Location</h1>
                                    </div>
                                </section>

                                <section class="sub-section-row">

                                    <div class="section-description sub-column">
                                        <section class="description-detail">
                                            <h2>Property address</h2>
                                            <p>The property address will be used to place a pin on the map for users browsing listing. The precise location will not be shared until booking.</p>
                                        </section>
                                    </div>

                                    <div class="sub-column map-wrap">
                                        <div id="submit-property-geocoder" class="geocoder">
                                            <label for="property-location-input">Property Address</label>
                                        </div>
                            
                                        <div id="submit-property-map" style="height: 350px;width: 100%;">
                                            <svg width="16" height="26" viewBox="0 0 16 26" fill="none" xmlns="http://www.w3.org/2000/svg" class="marker" v-if="addressIsSelected">
                                                <ellipse cx="8" cy="24.5" rx="5" ry="1.5" fill="black" fill-opacity="0.1"/>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.0244141 8C0.0293565 3.58378 3.59557 0.00495989 7.99625 0C12.3969 0.00495989 15.9631 3.58378 15.9681 8C15.9681 11.514 10.9857 20.026 8.84525 23.523C8.66536 23.8206 8.34308 24.0017 7.99625 24C7.65007 24.0001 7.32864 23.8199 7.14725 23.524C5.00681 20.025 0.0244141 11.51 0.0244141 8ZM4.50854 8C4.50854 9.933 6.07004 11.5 7.99623 11.5C9.92243 11.5 11.4839 9.933 11.4839 8C11.4839 6.067 9.92243 4.5 7.99623 4.5C6.07004 4.5 4.50854 6.067 4.50854 8Z" fill="#9080F0"/>
                                            </svg>
                                        </div>

                                        <div class="icon-message" :class="{visible: addressIsSelected}">
                                            <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 15.75C13.6569 15.75 15 14.4069 15 12.75C15 11.0931 13.6569 9.75 12 9.75C10.3431 9.75 9 11.0931 9 12.75C9 14.4069 10.3431 15.75 12 15.75Z" stroke="#9080F0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 6.75C15.3137 6.75 18 9.43629 18 12.75C18 15.422 14.1 21.055 12.589 22.965C12.4468 23.145 12.2299 23.2501 12.0005 23.2501C11.7711 23.2501 11.5542 23.145 11.412 22.965C9.9 21.054 6 15.422 6 12.75C6 9.43629 8.68629 6.75 12 6.75Z" stroke="#9080F0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M12 0.75V3.75" stroke="#9080F0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M19 3.00293L17.25 5.43993" stroke="#9080F0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M5 3.00293L6.75 5.43993" stroke="#9080F0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M0.75 9L3.472 9.875" stroke="#9080F0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M23.2498 9L20.5278 9.875" stroke="#9080F0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span>Drag the map around for a more precise pin location.</span>
                                        </div>

                                    </div>

                                    <input type="hidden" name="address1" v-model="address1" />
                                    <input type="hidden" name="city" v-model="city" />
                                    <input type="hidden" name="state"  v-model="state" />
                                    <input type="hidden" name="postal_code" v-model="postal_code" />
                                </section><!-- END sub-section-row -->
                            </fieldset>

                            <!-- Property Details Section -->
                            <fieldset class="section-wrap" v-show="visibleSection == 3">

                                <section class="sub-section-row">

                                    <div class="sub-column">

                                    </div>

                                    <div class="sub-column">
                                        <h1>Property Details</h1>
                                    </div>


                                </section>

                                <section class="sub-section-row">

                                    <div class="section-description sub-column">
                                        <section class="description-detail">
                                            <h2>Property Title</h2>
                                            <p>The property title is a short, memorable description of your spot. It will appear at the top of your spot’s listing.</p>
                                        </section>
                                    </div>

                                    <div class="sub-column">
                                        <section class="fieldset required single-field add-on"
                                            :class="{'has-error': errors.has('scope-3.name')}">
                                            <input type="text" id="property-title" name="name" v-model="name" :disabled="isSubmitting"
                                                :class="{'filled': (name.length || name > 0), 'ouch': errors.has('scope-3.name')}"
                                                :maxlength="40"
                                                v-validate="'required|max:40'" data-vv-as="Property Title" data-vv-scope="scope-3" placeholder="eg Gorgeous Cabin on Lake Travis" />
                                            <label for="property-title">Property Title</label>
                                            <span class="errors"
                                                v-if="errors.has('scope-3.name')">{{ errors.first('scope-3.name') }}</span>
                                            <div class="add-on pill" v-text="40 - name.length"></div>
                                        </section>
                                        <section class="fieldset required single-field"
                                            :class="{'has-error': errors.has('scope-3.website')}">
                                            <input type="url" id="property-website" name="website" v-model="website" :disabled="isSubmitting"
                                                :class="{'filled': (website.length || website > 0), 'ouch': errors.has('scope-3.website')}"
                                                data-vv-as="Property Website" data-vv-scope="scope-3" />
                                            <label for="property-website">Property Website</label>
                                            <span class="errors"
                                                v-if="errors.has('scope-3.website')">{{ errors.first('scope-3.website') }}</span>
                                        </section>
                                        <section class="fieldset required single-field has-prefix prefix-sm"
                                            :class="{'has-error': errors.has('scope-3.price'), 'filled': (price.length || price > 0)}">
                                            <input type="url" id="property-price" name="price" v-model="price" :disabled="isSubmitting"
                                                :class="{'filled': (price.length || price > 0), 'ouch': errors.has('scope-3.price')}"
                                                v-validate="'required'" data-vv-as="Price per Night" data-vv-scope="scope-3" />
                                            <label for="property-price">Price per Night</label>
                                            <label for="property-price" class="prefix text">$</label>
                                            <span class="errors"
                                                v-if="errors.has('scope-3.price')">{{ errors.first('scope-3.price') }}</span>
                                        </section>
                                    </div>
                                </section>

                                <h2 class="section-title">Accommodations</h2>

                                <section class="sub-section-row">

                                    <div class="section-description sub-column">
                                        <section class="description-detail">
                                            <h2>Accommodations</h2>
                                            <p>How many guests can your spot be expected to comfortably accomodate?</p>
                                        </section>
                                    </div>

                                    <div class="sub-column">
                                        <section class="fieldset">

                                            <section class="fieldset single-field"
                                                :class="{'has-error': errors.has('scope-3.beds')}">
                                                <input type="text" id="property-beds" name="beds" v-model="beds" :disabled="isSubmitting"
                                                    :class="{'filled': (beds.length || beds > 0), 'ouch': errors.has('scope-3.beds')}"
                                                    v-validate="'required|between:0,10'" data-vv-as="Number of Beds" data-vv-scope="scope-3" />
                                                <label for="property-beds">Number of Beds</label>
                                                <span class="errors"
                                                    v-if="errors.has('scope-3.beds')">{{ errors.first('scope-3.beds') }}</span>
                                            </section>

                                            <section class="fieldset single-field"
                                                :class="{'has-error': errors.has('scope-3.baths')}">
                                                <input type="baths" name="baths" id="property-baths" v-model="baths" :disabled="isSubmitting"
                                                    :class="{'filled': (baths.length || baths > 0), 'ouch': errors.has('scope-3.baths')}"
                                                    v-validate="'required|between:0,20'" data-vv-as="Number of Baths" data-vv-scope="scope-3" />
                                                <label for="property-baths">Number of Baths</label>
                                                <span class="errors"
                                                    v-if="errors.has('scope-3.baths')">{{ errors.first('scope-3.baths') }}</span>
                                            </section>

                                        </section>

                                        <section class="fieldset">
                                            <section class="fieldset single-field half-width"
                                                :class="{'has-error': errors.has('scope-3.sleeps')}">
                                                <input type="url" id="property-sleeps" name="sleeps" v-model="sleeps" :disabled="isSubmitting"
                                                    :class="{'filled': (sleeps.length || sleeps > 0), 'ouch': errors.has('scope-3.sleeps')}"
                                                    v-validate="'required|between:0,30'" data-vv-as="Comfortably Sleeps" data-vv-scope="scope-3" />
                                                <label for="property-sleeps">Comfortably Sleeps</label>
                                                <span class="errors"
                                                    v-if="errors.has('scope-3.sleeps')">{{ errors.first('scope-3.sleeps') }}</span>
                                            </section>
                                        </section>
                                    </div>
                                </section>

                                <h2 class="section-title">Amenities</h2>

                                <!-- Adding this nested wrap to allow me to split out floating comments -->
                                <section class="sub-section-row">

                                    <div class="section-description sub-column">
                                        <section class="description-detail">
                                            <h2>Amenities</h2>
                                            <p>Amenities are not required, but the more the merrier - Help your
                                                guests feel more at home by selecting all that your spot offers.</p>
                                        </section>
                                    </div>

                                    <div class="sub-column">

                                        <!-- <ul class="amenities">
                                            <li class="check-group" v-for="amenity in amenities">
                                                <input type="checkbox" :name="'amenities['+amenity.id+']'" :value="amenity.id" :disabled="isSubmitting"
                                                    :id="'check-amenity-'+amenity.id" v-model="selectedAmenities">
                                                <label :for="'check-amenity-'+amenity.id"
                                                    v-text="amenity.name"></label>
                                            </li>
                                        </ul> -->
                                        <div v-for="(group, title) in groupedAmenities">
                                            <h3 v-text="title"></h3>
                                            <ul class="amenities">
                                                <li class="check-group" v-for="amenity in group">
                                                    <input type="checkbox" :name="'amenities['+amenity.id+']'" :value="amenity.id" :disabled="isSubmitting"
                                                        :id="'check-amenity-'+amenity.id" v-model="selectedAmenities">
                                                    <label :for="'check-amenity-'+amenity.id"
                                                        v-text="amenity.name"></label>
                                                </li>
                                            </ul>
                                        </div>

                                    </div><!-- End sub column -->

                                </section><!-- END sub-section-row -->

                                <section class="sub-section-row">

                                    <div class="section-description sub-column">
                                        <section class="description-detail">
                                            <h2>Property description</h2>
                                            <p>To help people understand why they should choose your property during
                                                their time off, write as detailed a description as you desire.</p>
                                        </section>
                                    </div>

                                    <div class="sub-column mob-pad">

                                        <trix id="property-description" :value="desc" :disabled="isSubmitting" :withFiles="false"
                                            :class="{'filled': (desc.length || desc > 0), 'ouch': errors.has('scope-3.desc')}" data-vv-scope="scope-3"
                                            @change="trixChange"
                                            />

                                    </div><!-- End sub column -->

                                </section><!-- END sub-section-row -->

                            </fieldset>

                            <!-- Property Photos Section -->
                            <property-photos
                                v-show="visibleSection == 4"
                            ></property-photos>

                            <input type="hidden" name="lat" :value="lat" />
                            <input type="hidden" name="lng" :value="lng" />
                            <input type="hidden" name="_token" :value="csrf" />

                        </form>

                    </div>


                </div>

                <div class="row action-row">
                    <div v-show="visibleSection === 4" class="check-group rounded">
                        <input type="checkbox" name="terms_agree" id="terms_agree" />
                        <label for="terms_agree">I have read and agree to the SweetSpot terms of service</label>
                    </div>

                    <button class="btn secondary" @click.prevent="backButtonClicked" type="button" v-if="visibleSection > 1">Back</button>

                    <button v-if="visibleSection < 4" class="btn" @click.prevent="saveAndContinue" type="button">Save & Continue</button>
                    <button v-if="visibleSection == 4" class="btn" id="new-property-submit" name="new-property-submit" @click.prevent="submitForm">Submit</button>
                </div>
            
            <!-- </form> -->
        
        </div>

    </section>
</template>

<script>
    import VeeValidate from 'vee-validate';
    import { Validator } from 'vee-validate';
    Vue.use(VeeValidate);
    const dict = {
        en: {
            // messages: {
            //     required: () => 'This field is required'
            // },
            // custom: {
            //     scheduled_time: {
            //         scheduled_time: 'You must select a date and time'
            //     },
            // }
        },
    };
    Validator.localize(dict);
    import VeeValidateLaravel from 'vee-validate-laravel';
    Vue.use(VeeValidateLaravel);
    
    import Trix from "../../components/Trix";
    Vue.component('trix', Trix);

    import PropertyPhotos from './PropertyPhotos.vue';
    Vue.component('property-photos', PropertyPhotos);

    let mapboxgl = require('mapbox-gl');
    let MapboxGeocoder = require('mapbox-gl-geocoder');

    mapboxgl.accessToken = process.env.MIX_MAPBOX_APP_KEY;

    export default {
        props: ['amenities'],
        data() {
            return {
                'owner_name' : '',
                'website' : '',
                'email' : '',
                'email_confirmation' : '',
                'phone' : '',
                'name' : '',
                'desc' : '',
                'price' : '',
                'sleeps' : '',
                'baths' : '',
                'beds' : '',
                'terms_agree': false,

                'addressIsSelected' : false,
                'address1' : '',
                'city' : '',
                'state' : '',
                'postal_code' : '',
                'selectedAmenities' : [],

                'lat': '',
                'lng': '',

                'map' : '',
                'geocoder': '',

                'visibleSection' : 1,
                'isSubmitting': false,
            }
        },
        methods: {
            clearAllFields() {
                let fields = {
                    'owner_name' : '',
                    'website' : '',
                    'email' : '',
                    'email_confirmation' : '',
                    'phone' : '',
                    'name' : '',
                    'desc' : '',
                    'price' : '',
                    'sleeps' : '',
                    'baths' : '',
                    'beds' : '',
                    'terms_agree': false,

                    'addressIsSelected' : false,
                    'address1' : '',
                    'city' : '',
                    'state' : '',
                    'postal_code' : '',
                    'selectedAmenities' : [],

                    'lat': '',
                    'lng': '',

                    'map' : '',
                    'geocoder': '',

                    'visibleSection' : 1,
                    'isSubmitting': false,
                }

                for (let key in fields) {
                    this[key] = fields[key];
                }
                this.errors.clear();
            },
            addressSelected(ev) {
                let context = ev.result.context;
                // this.map.getSource('single-point').setData(ev.result.geometry);
                let coords = ev.result.geometry.coordinates;

                this.address1 = ((ev.result.address) ? ev.result.address + ' ' : '') + ev.result.text;
                this.city = context.find(e => e.id.includes('place')).text;
                this.postal_code = context.find(e => e.id.includes('postcode')).text;
                this.state = context.find(e => e.id.includes('region')).text;
                this.lng = coords[0];
                this.lat = coords[1];
                
                this.addressIsSelected = true;
                this.map.jumpTo({
                    center: coords,
                    zoom: 16
                })
            },
            addressCleared(ev) {
                this.address_street = '';
                this.address_city = '';
                this.address_zip = '';
                this.address_state = '';

                this.map.jumpTo({
                    center: [-98.5833, 39.833333],
                    zoom: 2
                })
                this.lng = '';
                this.lat = '';
                
                this.addressIsSelected = false;
            },
            mapMoved(ev) {
                if (this.addressIsSelected) {
                    let coords = this.map.getCenter();
                    this.lat = coords.lat;
                    this.lng = coords.lng;
                }
            },
            saveAndContinue() {
                this.validateVisibleFields()
                    .then(() => {
                        if (!this.errors.items.length) {
                            let newSection = this.visibleSection + 1;
                            if (newSection > 4) {
                               return false;
                            } else {
                                this.goToSection(newSection);
                            }
                        } else {
                            console.log('error!');
                        }
                    }
                )

                
                // if (newSection > 4) {
                //     // TODO Submit the form
                //     return false;
                // } else {
                //     this.goToSection(newSection);
                // }
            },
            backButtonClicked() {
                let newSection = this.visibleSection - 1;
                if (newSection < 1) {
                    return false;
                } else {
                    this.goToSection(newSection);
                }
            },
            goToSection(num) {
                this.visibleSection = num;
                this.map.resize();
                if (this.visibleSection == 2) {
                    let self = this;
                    setTimeout(function(){self.map.resize();},10);
                }
            },
            trixChange(ev) {
                this.desc = ev;
            },
            validateVisibleFields() {
                return this.$validator.validate('scope-'+this.visibleSection+'.*')
            },
            submitForm(event) {
                if (event.target.id == 'new-property-submit') {
                    this.sendRequest();
                } else {
                    event.preventDefault();
                }
            },
            sendRequest() {
                this.isSubmitting = true;
                this.$emit('submitting');
                let fields = [
                    'owner_name',
                    'website',
                    'email',
                    'email_confirmation',
                    'phone',
                    'name',
                    'desc',
                    'price',
                    'sleeps',
                    'baths',
                    'beds',

                    'address1',
                    'city',
                    'state',
                    'postal_code',

                    'lat',
                    'lng',
                ];
                let self = this;
                let formData = {}
                fields.forEach((field) => {
                    formData[field] = self[field];
                });

                formData.amenity_ids = this.selectedAmenities;
                formData.photos = this.photoMediaIds;

                axios.post('/api/submissions', formData)
                    .then(response => {
                        console.log(response)
                        this.isSubmitting = false;
                        this.$emit('not-submitting');
                        this.$emit('success');
                    })
                    .catch(err => {
                        this.$setLaravelValidationErrorsFromResponse(err.response.data)
                        this.isSubmitting = false;
                        this.$emit('not-submitting');
                    });
            },

            fillFakeData() {
                console.log('fakey')
                var faker = require('faker');
                this.owner_name = faker.name.findName()
                this.website = faker.internet.url()
                this.email = faker.internet.email()
                this.email_confirmation = this.email;
                this.phone = faker.phone.phoneNumber();
                this.name = faker.lorem.sentence();
                this.desc = faker.lorem.paragraph()
                this.price = Math.floor((Math.random() * 500) + 1);
                this.sleeps = Math.floor((Math.random() * 20) + 1);
                this.baths = Math.floor((Math.random() * 10) + 1);
                this.beds = Math.floor((Math.random() * 10) + 1);
                this.address1 = faker.address.streetAddress()
                this.city = faker.address.city();
                this.state = faker.address.state();
                this.postal_code = faker.address.zipCode();
                this.lat = faker.address.latitude()
                this.lng = faker.address.longitude()
            },
        },
        computed: {
            csrf() {
                return window.Laravel.csrfToken;
            },
            photos() {
                return this.$store.state.uploads;
            },
            photoMediaIds() {
                return this.photos.map(el => el.id)
            },
            groupedAmenities() {
                return this.amenities.reduce((objectsByKeyValue, obj) => {
                    const value = obj['type'];
                    objectsByKeyValue[value] = (objectsByKeyValue[value] || []).concat(obj);
                    return objectsByKeyValue;
                }, {});
            }
        },
        mounted() {
            console.log('loading');
            // console.log(mapboxgl);
            this.map = new mapboxgl.Map({
                container: 'submit-property-map',
                style: 'mapbox://styles/mapbox/light-v10',
                center: [-98.5833, 39.833333],
                zoom: 2
            });
            this.map.addControl(new mapboxgl.NavigationControl({
                showCompass: false
            }));
            this.geocoder = new MapboxGeocoder({
                accessToken: mapboxgl.accessToken,
                country : 'US',
                types: 'address',
                placeholder: '',
                flyTo: false
            });
            document.getElementById('submit-property-geocoder').appendChild(this.geocoder.onAdd(this.map));
            document.querySelector('#submit-property-geocoder .mapboxgl-ctrl-geocoder input').id = 'property-location-input';
            
            // let label = document.createElement('label');
            // label.setAttribute("for", "property-location-input");
            // label.appendChild(document.createTextNode('Property Address'));
            // document.querySelector('#submit-property-geocoder .mapboxgl-ctrl-geocoder').appendChild(label);

            this.map.on('load', () => {
                // this.map.addSource('single-point', {
                //     "type": "geojson",
                //     "data": {
                //     "type": "FeatureCollection",
                //     "features": []
                //     }
                // })
                // this.map.addLayer({
                //     "id": "point",
                //     "source": "single-point",
                //     "type": "circle",
                //     "paint": {
                //     "circle-radius": 10,
                //     "circle-color": "#007cbf"
                //     }
                // });
                this.geocoder.on('result', this.addressSelected);
                this.geocoder.on('clear', this.addressCleared);

                this.map.on('dragend', this.mapMoved);
                this.map.on('zoomend', this.mapMoved);
            })
        },
        watch: {
            'geocoder.result' : 'addressSelected'
        },
    }
</script>

<style>
    .mapboxgl-ctrl-geocoder.mapboxgl-ctrl {
        width:100%;
    }
</style>

