<template lang="html">
    <div class="row mb-5">
        <question
            v-for="question in this.sampleSurvey"
            :key="question.id"
            :question="question"
            :answers="this.answers">
        </question>
    </div>
</template>

<script>
export default {
    data() {
        return {
            sampleSurvey: [
                {
                    id: 1,
                    required: true,
                    text: "What is your name?",
                    type: 'shorttext'
                }
            ],
            answers: []
        }
    },
    props: ['survey'],
    created: function() {
        //This method runs after the instance is created
        this.initializeSurvey();
    },
    methods: {
        initializeSurvey() {

        }
    }
}
</script>
