import './bootstrap';


import "flyonui/flyonui"

import Alpine from 'alpinejs'

import { Editor } from '@tiptap/core'
import StarterKit from '@tiptap/starter-kit'


document.addEventListener('alpine:init', () => {
    Alpine.data('editor', (content) => {
        let editor // Alpine's reactive engine automatically wraps component properties in proxy objects. If you attempt to use a proxied editor instance to apply a transaction, it will cause a "Range Error: Applying a mismatched transaction", so be sure to unwrap it using Alpine.raw(), or simply avoid storing your editor as a component property, as shown in this example.

        return {
            updatedAt: Date.now(), // force Alpine to rerender on selection change
            init() {
                const _this = this

                editor = new Editor({
                    element: this.$refs.element,
                    extensions: [StarterKit],
                    content: content,
                    onCreate({ editor }) {
                        _this.updatedAt = Date.now();
                        _this.$refs.hiddenInput.value = editor.getHTML()
                    },
                    onUpdate({ editor }) {
                        _this.updatedAt = Date.now()
                        _this.$refs.hiddenInput.value = editor.getHTML()
                    },
                    onSelectionUpdate({ editor }) {
                        _this.updatedAt = Date.now()
                        _this.$refs.hiddenInput.value = editor.getHTML()
                    },
                })
            },
            isLoaded() {
                return editor
            },
            isActive(type, opts = {}) {
                return editor.isActive(type, opts)
            },
            setParagraph() {
                editor.commands.setParagraph()
            },
            toggleHeading(opts) {
                editor.chain().toggleHeading(opts).focus().run()
            },
            toggleBold() {
                editor.chain().focus().toggleBold().run()
            },
            toggleItalic() {
                editor.chain().toggleItalic().focus().run()
            },
            toggleUnderline() {
                editor.chain().focus().toggleUnderline().run()
            },
            toggleCode() {
                editor.chain().focus().toggleCode().run()
            },
            toggleBulletList() {
                editor.chain().focus().toggleBulletList().run()
            },
            toggleOrderedList() {
                editor.chain().focus().toggleOrderedList().run()
            },
        }
    })
})
window.Alpine = Alpine

Alpine.start();
