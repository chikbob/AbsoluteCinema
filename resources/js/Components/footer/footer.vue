<template>
    <footer class="footer w-full max-w-[1320px]">
        <div class="footer__annotation">
            <div class="footer__annotation-name">
                © {{ yearNow }} AbsoluteCinema
            </div>
            <div class="footer__annotation-description">
                Ваші неперевершені враження.
            </div>
        </div>
        <div class="footer__social">
            <a href="/" class="footer__social-link">
                <img src="../../../../public/icons/telegram.png" alt="telegram.png">
            </a>
            <a href="/" class="footer__social-link">
                <img src="../../../../public/icons/vk.png" alt="vk.png">
            </a>
        </div>
        <div class="footer__links">
            <a href="/" class="footer__links-link">
                Умови обслуговування
            </a>
            <a href="/" class="footer__links-link">
                Політика конфіденційності
            </a>
        </div>
    </footer>
</template>

<script setup>
const yearNow = new Date().getFullYear()
</script>

<style lang="scss" scoped>
.footer {
    display: flex;
    justify-content: space-between;
    padding: 0 60px;
    margin: 0 auto 0;

    height: 84px;
    border-radius: 100px 100px 0 0;
    background: rgb(48, 48, 61);

    &__annotation {
        display: flex;
        flex-direction: column;
        justify-content: center;

        &-name {
            font-size: 24px;
        }

        &-description {
            font-size: 18px;
        }
    }

    &__social {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 203px;
        height: 68px;
        border-radius: 0 0 100px 100px;
        margin: 0 0 16px 0 !important;

        background: rgb(21, 21, 25);

        &-link {
            width: 42px;
            height: 42px;

            &:first-child {
                margin: 0 23px 0 0;
            }
        }
    }

    &__links {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-end;

        &-link {
            font-size: 18px;
            text-decoration: none;
        }
    }
}
</style>
