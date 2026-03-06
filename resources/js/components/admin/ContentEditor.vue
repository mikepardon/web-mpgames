<template>
    <div class="content-editor border border-slate-700 rounded-xl overflow-hidden bg-surface">
        <!-- Toolbar -->
        <div class="flex items-center gap-0.5 px-2 py-1.5 bg-surface-light border-b border-slate-700 flex-wrap">
            <!-- Heading dropdown -->
            <div class="relative" ref="headingDropdownRef">
                <button
                    type="button"
                    @click="showHeadingDropdown = !showHeadingDropdown"
                    class="toolbar-btn px-2 gap-1"
                    title="Headings"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" /></svg>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                </button>
                <div v-if="showHeadingDropdown" class="absolute top-full left-0 mt-1 bg-surface-light border border-slate-700 rounded-lg shadow-xl z-20 py-1 min-w-[140px]">
                    <button type="button" @click="insertHeading(1)" class="w-full text-left px-3 py-1.5 text-sm text-slate-300 hover:bg-surface-lighter hover:text-white transition">
                        <span class="font-bold text-lg">H1</span> <span class="text-slate-500 ml-2">Heading 1</span>
                    </button>
                    <button type="button" @click="insertHeading(2)" class="w-full text-left px-3 py-1.5 text-sm text-slate-300 hover:bg-surface-lighter hover:text-white transition">
                        <span class="font-bold text-base">H2</span> <span class="text-slate-500 ml-2">Heading 2</span>
                    </button>
                    <button type="button" @click="insertHeading(3)" class="w-full text-left px-3 py-1.5 text-sm text-slate-300 hover:bg-surface-lighter hover:text-white transition">
                        <span class="font-bold text-sm">H3</span> <span class="text-slate-500 ml-2">Heading 3</span>
                    </button>
                </div>
            </div>

            <div class="w-px h-5 bg-slate-700 mx-1"></div>

            <!-- Inline formatting -->
            <button type="button" @click="wrapSelection('**', '**')" class="toolbar-btn" title="Bold (Ctrl+B)">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 4h8a4 4 0 014 4 4 4 0 01-4 4H6z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 12h9a4 4 0 014 4 4 4 0 01-4 4H6z" /></svg>
            </button>
            <button type="button" @click="wrapSelection('*', '*')" class="toolbar-btn" title="Italic (Ctrl+I)">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 4h4m-2 0l-4 16m0 0h4" /></svg>
            </button>

            <div class="w-px h-5 bg-slate-700 mx-1"></div>

            <!-- Block formatting -->
            <button type="button" @click="insertList('- ')" class="toolbar-btn" title="Bullet list">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" /></svg>
            </button>
            <button type="button" @click="insertList('1. ')" class="toolbar-btn" title="Numbered list">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6h11M10 12h11M10 18h11" /><text x="2" y="8" font-size="7" fill="currentColor" stroke="none" font-weight="bold">1</text><text x="2" y="14" font-size="7" fill="currentColor" stroke="none" font-weight="bold">2</text><text x="2" y="20" font-size="7" fill="currentColor" stroke="none" font-weight="bold">3</text></svg>
            </button>
            <button type="button" @click="insertBlockquote" class="toolbar-btn" title="Blockquote">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M4.583 17.321C3.553 16.227 3 15 3 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311C9.591 11.69 11 13.182 11 15c0 1.933-1.567 3.5-3.5 3.5-1.315 0-2.519-.614-2.917-1.179zM14.583 17.321C13.553 16.227 13 15 13 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311C19.591 11.69 21 13.182 21 15c0 1.933-1.567 3.5-3.5 3.5-1.315 0-2.519-.614-2.917-1.179z"/></svg>
            </button>

            <div class="w-px h-5 bg-slate-700 mx-1"></div>

            <!-- Links and media -->
            <button type="button" @click="insertLink" class="toolbar-btn" title="Link (Ctrl+K)">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg>
            </button>
            <button type="button" @click="insertCode" class="toolbar-btn" title="Inline code">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" /></svg>
            </button>
            <button type="button" @click="insertHorizontalRule" class="toolbar-btn" title="Horizontal rule">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14" /></svg>
            </button>

            <!-- Spacer -->
            <div class="flex-1"></div>

            <!-- View mode toggle -->
            <div class="flex items-center bg-surface rounded-lg p-0.5">
                <button
                    type="button"
                    @click="viewMode = 'edit'"
                    class="px-2.5 py-1 text-xs font-medium rounded-md transition"
                    :class="viewMode === 'edit' ? 'bg-surface-lighter text-white' : 'text-slate-500 hover:text-slate-300'"
                >
                    Edit
                </button>
                <button
                    type="button"
                    @click="viewMode = 'split'"
                    class="px-2.5 py-1 text-xs font-medium rounded-md transition"
                    :class="viewMode === 'split' ? 'bg-surface-lighter text-white' : 'text-slate-500 hover:text-slate-300'"
                >
                    Split
                </button>
                <button
                    type="button"
                    @click="viewMode = 'preview'"
                    class="px-2.5 py-1 text-xs font-medium rounded-md transition"
                    :class="viewMode === 'preview' ? 'bg-surface-lighter text-white' : 'text-slate-500 hover:text-slate-300'"
                >
                    Preview
                </button>
            </div>
        </div>

        <!-- Editor body -->
        <div class="flex" :class="{ 'divide-x divide-slate-700': viewMode === 'split' }">
            <!-- Textarea -->
            <div v-show="viewMode !== 'preview'" :class="viewMode === 'split' ? 'w-1/2' : 'w-full'">
                <textarea
                    ref="textareaRef"
                    :value="modelValue"
                    @input="$emit('update:modelValue', $event.target.value)"
                    @keydown="handleKeydown"
                    class="w-full h-[600px] px-5 py-4 bg-transparent text-slate-200 font-mono text-sm leading-relaxed resize-none focus:outline-none placeholder-slate-600"
                    :placeholder="placeholder"
                    spellcheck="false"
                ></textarea>
            </div>

            <!-- Preview -->
            <div v-show="viewMode !== 'edit'" :class="viewMode === 'split' ? 'w-1/2' : 'w-full'">
                <div class="h-[600px] overflow-y-auto px-6 py-4">
                    <div class="prose-rendered" v-html="renderedHtml"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { marked } from 'marked';
import DOMPurify from 'dompurify';

const props = defineProps({
    modelValue: {
        type: String,
        default: '',
    },
    placeholder: {
        type: String,
        default: 'Write your content using Markdown...',
    },
});

const emit = defineEmits(['update:modelValue']);

const textareaRef = ref(null);
const viewMode = ref('split');
const showHeadingDropdown = ref(false);
const headingDropdownRef = ref(null);

// Markdown rendering
const renderedHtml = computed(() => {
    if (!props.modelValue) return '<p class="text-slate-600 italic">Nothing to preview</p>';
    const raw = marked.parse(props.modelValue);
    return DOMPurify.sanitize(raw);
});

// Close dropdown on outside click
function handleClickOutside(e) {
    if (headingDropdownRef.value && !headingDropdownRef.value.contains(e.target)) {
        showHeadingDropdown.value = false;
    }
}

onMounted(() => document.addEventListener('click', handleClickOutside));
onUnmounted(() => document.removeEventListener('click', handleClickOutside));

// Keyboard shortcuts
function handleKeydown(e) {
    if ((e.ctrlKey || e.metaKey) && e.key === 'b') {
        e.preventDefault();
        wrapSelection('**', '**');
    } else if ((e.ctrlKey || e.metaKey) && e.key === 'i') {
        e.preventDefault();
        wrapSelection('*', '*');
    } else if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
        e.preventDefault();
        insertLink();
    } else if (e.key === 'Tab') {
        e.preventDefault();
        insertAtCursor('    ');
    }
}

// Helper: get textarea selection info
function getSelection() {
    const ta = textareaRef.value;
    if (!ta) return null;
    return {
        start: ta.selectionStart,
        end: ta.selectionEnd,
        text: props.modelValue.substring(ta.selectionStart, ta.selectionEnd),
    };
}

// Helper: replace text and update cursor
function replaceAndSelect(newValue, selStart, selEnd) {
    emit('update:modelValue', newValue);
    requestAnimationFrame(() => {
        const ta = textareaRef.value;
        if (ta) {
            ta.focus();
            ta.setSelectionRange(selStart, selEnd);
        }
    });
}

// Wrap selected text with prefix/suffix
function wrapSelection(prefix, suffix) {
    const sel = getSelection();
    if (!sel) return;
    const val = props.modelValue;

    if (sel.text) {
        // If selection is already wrapped, unwrap it
        const before = val.substring(Math.max(0, sel.start - prefix.length), sel.start);
        const after = val.substring(sel.end, sel.end + suffix.length);
        if (before === prefix && after === suffix) {
            const newVal = val.substring(0, sel.start - prefix.length) + sel.text + val.substring(sel.end + suffix.length);
            replaceAndSelect(newVal, sel.start - prefix.length, sel.end - prefix.length);
            return;
        }
        const newVal = val.substring(0, sel.start) + prefix + sel.text + suffix + val.substring(sel.end);
        replaceAndSelect(newVal, sel.start + prefix.length, sel.end + prefix.length);
    } else {
        const placeholder = prefix === '**' ? 'bold text' : prefix === '*' ? 'italic text' : 'text';
        const newVal = val.substring(0, sel.start) + prefix + placeholder + suffix + val.substring(sel.end);
        replaceAndSelect(newVal, sel.start + prefix.length, sel.start + prefix.length + placeholder.length);
    }
}

// Insert text at cursor
function insertAtCursor(text) {
    const sel = getSelection();
    if (!sel) return;
    const val = props.modelValue;
    const newVal = val.substring(0, sel.start) + text + val.substring(sel.end);
    replaceAndSelect(newVal, sel.start + text.length, sel.start + text.length);
}

// Insert heading at line start
function insertHeading(level) {
    showHeadingDropdown.value = false;
    const sel = getSelection();
    if (!sel) return;
    const val = props.modelValue;
    const prefix = '#'.repeat(level) + ' ';

    // Find the start of the current line
    const lineStart = val.lastIndexOf('\n', sel.start - 1) + 1;
    const lineEnd = val.indexOf('\n', sel.start);
    const line = val.substring(lineStart, lineEnd === -1 ? val.length : lineEnd);

    // Strip any existing heading prefix
    const stripped = line.replace(/^#{1,6}\s*/, '');
    const newLine = prefix + stripped;
    const newVal = val.substring(0, lineStart) + newLine + val.substring(lineEnd === -1 ? val.length : lineEnd);
    replaceAndSelect(newVal, lineStart + prefix.length, lineStart + newLine.length);
}

// Insert list prefix on each selected line
function insertList(prefix) {
    const sel = getSelection();
    if (!sel) return;
    const val = props.modelValue;

    if (sel.text) {
        const lines = sel.text.split('\n');
        const prefixed = lines.map((line, i) => {
            if (!line.trim()) return line;
            if (prefix === '1. ') return `${i + 1}. ${line}`;
            return prefix + line;
        }).join('\n');
        const newVal = val.substring(0, sel.start) + prefixed + val.substring(sel.end);
        replaceAndSelect(newVal, sel.start, sel.start + prefixed.length);
    } else {
        const text = prefix === '1. ' ? '1. List item' : '- List item';
        // Ensure we're on a new line
        const needsNewline = sel.start > 0 && val[sel.start - 1] !== '\n';
        const insert = (needsNewline ? '\n' : '') + text;
        const newVal = val.substring(0, sel.start) + insert + val.substring(sel.end);
        const offset = needsNewline ? 1 : 0;
        replaceAndSelect(newVal, sel.start + offset + prefix.length, sel.start + insert.length);
    }
}

// Insert blockquote
function insertBlockquote() {
    const sel = getSelection();
    if (!sel) return;
    const val = props.modelValue;

    if (sel.text) {
        const lines = sel.text.split('\n');
        const quoted = lines.map(line => '> ' + line).join('\n');
        const newVal = val.substring(0, sel.start) + quoted + val.substring(sel.end);
        replaceAndSelect(newVal, sel.start, sel.start + quoted.length);
    } else {
        const text = '> Quote';
        const needsNewline = sel.start > 0 && val[sel.start - 1] !== '\n';
        const insert = (needsNewline ? '\n' : '') + text;
        const newVal = val.substring(0, sel.start) + insert + val.substring(sel.end);
        const offset = needsNewline ? 1 : 0;
        replaceAndSelect(newVal, sel.start + offset + 2, sel.start + insert.length);
    }
}

// Insert link
function insertLink() {
    const sel = getSelection();
    if (!sel) return;
    const val = props.modelValue;

    if (sel.text) {
        const insert = `[${sel.text}](url)`;
        const newVal = val.substring(0, sel.start) + insert + val.substring(sel.end);
        // Select "url" so user can type the URL
        replaceAndSelect(newVal, sel.start + sel.text.length + 3, sel.start + sel.text.length + 6);
    } else {
        const insert = '[link text](url)';
        const newVal = val.substring(0, sel.start) + insert + val.substring(sel.end);
        replaceAndSelect(newVal, sel.start + 1, sel.start + 10);
    }
}

// Insert inline code
function insertCode() {
    wrapSelection('`', '`');
}

// Insert horizontal rule
function insertHorizontalRule() {
    const sel = getSelection();
    if (!sel) return;
    const val = props.modelValue;
    const needsNewline = sel.start > 0 && val[sel.start - 1] !== '\n';
    const insert = (needsNewline ? '\n' : '') + '\n---\n';
    const newVal = val.substring(0, sel.start) + insert + val.substring(sel.end);
    replaceAndSelect(newVal, sel.start + insert.length, sel.start + insert.length);
}
</script>

<style scoped>
.toolbar-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 2rem;
    height: 2rem;
    border-radius: 0.375rem;
    color: #94a3b8;
    transition: all 0.15s ease;
    cursor: pointer;
}
.toolbar-btn:hover {
    color: #fff;
    background: #1f2937;
}
.toolbar-btn.px-2 {
    width: auto;
}
</style>
