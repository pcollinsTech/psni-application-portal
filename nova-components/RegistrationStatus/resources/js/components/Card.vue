<template>
    <card class="flex flex-col items-center justify-center">

        <div class="no-underline --dim flex p-6">
            <div>
                <h3 class="mb-3 text-90 uppercase tracking-wide font-bold text-sm"><indicator_icon :field="field"></indicator_icon></h3>

                <p class="text-90 leading-normal" v-if="card.registration_open">Registration closes on {{ card.closing_date }} at {{ card.closing_time }}.</p>

            </div>
        </div>

    </card>
</template>

<script>
export default {
    props: [
        'card',

        // The following props are only available on resource detail cards...
        // 'resource',
        // 'resourceId',
        // 'resourceName',
    ],

    computed: {
        field: function() {
            return {
                shouldHide: false,
                withoutLabels: true,
                value: 'Registration Status',
                status: this.card.registration_open,
            }
        }
    },

    mounted() {
        //
        console.log(this.card)
    },
}
</script>
