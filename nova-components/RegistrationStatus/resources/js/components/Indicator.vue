<template>
    <span class="whitespace-no-wrap" v-if="!field.shouldHide">
        <span
            class="inline-block indicator-grey rounded-full w-2 h-2 mr-1"
            v-bind="colorClassStyle"
        />
        <span v-if="labelText">
            {{ labelText }}
        </span>
        <span v-else-if="field.unknownLabel && !field.withoutLabels">{{ field.unknownLabel }}</span>
        <span v-else>&mdash;</span>
    </span>
</template>

<script>
    export default {
        props: ['resource', 'resourceName', 'resourceId', 'field'],

        computed: {
            labelText() {
                if(this.field.status) {
                    return 'Student Registration Open'
                }

                return 'Student Registration Closed'
            },
            colorClassStyle() {
                let color = 'indicator-grey';

                if(this.field.status) {
                    color = 'indicator-success';
                } else {
                    color = 'indicator-danger';
                }

                return {
                    class: color
                }

                if (this.field.colors && this.field.colors.hasOwnProperty(this.field.value)) {
                    color = this.field.colors[this.field.value]
                }

                if (/^(?:#|var\(--|(?:rgb|hsl)a?\()/.test(color)) {
                    return {
                        style: `background:${color};`
                    }
                }

                return {
                    class: `indicator-${color}`
                }
            }
        }
    }
</script>

<style>
    .indicator-gray,
    .indicator-grey {
        background: #B8C2CC;
    }

    .indicator-info {
        background: var(--info);
    }

    .indicator-danger {
        background: var(--danger);
    }

    .indicator-warning {
        background: var(--warning);
    }

    .indicator-success {
        background: var(--success);
    }

    .indicator-black {
        background: #22292F;
    }

    .indicator-red {
        background: #E3342F;
    }

    .indicator-orange {
        background: #F6993F;
    }

    .indicator-yellow {
        background: #FFED4A;
    }

    .indicator-green {
        background: #38C172;
    }

    .indicator-teal {
        background: #4DC0B5;
    }

    .indicator-blue {
        background: #3490DC;
    }

    .indicator-indigo {
        background: #6574CD;
    }

    .indicator-purple {
        background: #9561E2;
    }

    .indicator-pink {
        background: #F66D9B;
    }
</style>
