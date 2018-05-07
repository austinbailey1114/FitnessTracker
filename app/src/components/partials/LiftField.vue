<template lang="html">
    <div class="lift-field">
        <p class="lift-prompt">{{ this.prompt }}</p>
        <input :id="this.id" class="numeric-input lift-input" type="text" :name="this.name" placeholder="pounds" autocomplete="off">
    </div>
</template>

<script>
export default {
    props: ['name', 'id', 'prompt']
}
</script>

<style lang="css">
</style>
