<template lang="html">
    <div>
        {{ question.text }}
        <short-text-question v-if="question.type='shorttext'"></short-text-question>
    </div>
</template>

<script>
export default {
    props: ['question'],
}
</script>
